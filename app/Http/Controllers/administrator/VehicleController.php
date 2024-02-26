<?php

namespace App\Http\Controllers\administrator;

use App\Exports\VehicleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Vehicle\StoreRequest;
use App\Http\Requests\Administrator\Vehicle\UpdateRequest;
use App\Imports\VehicleImport;
use App\Models\administrator\Unit;
use App\Models\administrator\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $vehicles = $this->search($request);
        return view('administrator.pages.vehicle.index', compact('vehicles'));
    }

    private function search($request){
        
        if(is_null($request->tai_trong)){
            $so_sanh = 'like';
            $tai_trong = '%%';
        }elseif($request->tai_trong == 1){
            $so_sanh = '<';
            $tai_trong = 3000;
        }elseif($request->tai_trong == 3){
            $so_sanh = '>';
            $tai_trong = 10000;
        }else{
            $so_sanh = '>';
            $tai_trong = 3000;
            $so_sanh_1 = '<';
            $tai_trong_1 = 10000;
        }
        // dd($tai_trong);
        $trang_thai = $request->trang_thai ?? '';
        $trang_thai = '%'.$trang_thai.'%';
        $loai_thung = $request->loai_thung ?? '';
        $loai_thung = '%'.$loai_thung.'%';
        $nhan_hieu = $request->nhan_hieu ?? '';
        $nhan_hieu = '%'.$nhan_hieu.'%';

        $vehicles = Vehicle::with('personal')
        ->where('trang_thai', 'like', $trang_thai)
        ->where('loai_thung', 'like', $loai_thung)
        ->where('khoi_luong_hang_hoa', $so_sanh, $tai_trong)->where('khoi_luong_hang_hoa', $so_sanh_1 ?? 'like', $tai_trong_1 ?? '%%')
        ->where('nhan_hieu', 'like', $nhan_hieu)
        ->with('unit')
        ->withTrashed(Auth::user()->role == 1 ? true : false)
        ->orderBy('loai_thung', 'DESC')
        ->orderBy('nhan_hieu', 'DESC')
        ->orderBy('khoi_luong_hang_hoa', 'DESC')
        ->get();

        return $vehicles;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        return view('administrator.pages.vehicle.create')
        ->with('units', $units);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(StoreRequest $request)
    {
        $fileName1 = $this->storeImage1($request);
        $fileName2 = $this->storeImage2($request);
        $arrayData = $this->insertData($request);
        $arrayData['so_xe'] = $request->so_xe;
        $arrayData['trang_thai'] = 'Hoạt động';
        $arrayData['image_url_1'] = $fileName1;
        $arrayData['image_url_2'] = $fileName2;
        
        Vehicle::create($arrayData);
        
        return redirect()->route('admin.vehicle.index')->with('msg', "Thêm xe $request->so_xe thành công");
    }

    public function show()
    {
        //   
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $so_xe)
    {
        $units = Unit::all();
        $vehicle = Vehicle::where('so_xe', $so_xe)->first();
        return view('administrator.pages.vehicle.detail')
        ->with('units', $units)
        ->with('vehicle', $vehicle);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $vehicle = Vehicle::find($id);
        if(!is_null($request->ngay_ban) && !is_null($vehicle->personal_id)){
            return redirect()->back()->with('msg', 'Xe đang được bàn giao. Vui lòng làm biên bản thu hồi!');
        }
        $oldImage1 = $vehicle->image_url_1;
        $oldImage2 = $vehicle->image_url_2;
        $arrayData = $this->insertData($request);
        $arrayData['ngay_ban'] = !is_null($request->ngay_ban) ? Carbon::createFromFormat('d/m/Y', $request->ngay_ban)->format('Y-m-d') : null;
        if(!is_null($request->ngay_ban)){
            $arrayData['trang_thai'] = 'Đã bán';
        }else{
            $arrayData['trang_thai'] = 'Hoạt động';
        }
        $fileName1 = $this->storeImage1($request);
        $fileName2 = $this->storeImage2($request);
        if(!is_null($fileName1)){
            $arrayData['image_url_1'] = $fileName1;
            if(!is_null($oldImage1)){
                unlink(public_path('image').'/'.$oldImage1);
            }            
        }
        if(!is_null($fileName2)){
            $arrayData['image_url_2'] = $fileName2;
            if(!is_null($oldImage2)){
                unlink(public_path('image').'/'.$oldImage2);
            }            
        }
        $vehicle->update($arrayData);
        return redirect()->route('admin.vehicle.index')->with('msg', "Cập nhật xe $request->so_xe thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect()->route('admin.vehicle.index')->with('msg', "Xóa xe $vehicle->so_xe thành công");
    }

    public function restore($id) {
        $vehicle = Vehicle::withTrashed()->find($id);
        $vehicle->restore();
        return redirect()->route('admin.vehicle.index')->with('msg', "Khôi phục thông tin xe $vehicle->so_xe thành công");
    }

    public function forceDelete($id) {
        $vehicle = Vehicle::withTrashed()->find($id);
        $vehicle->forceDelete();
        return redirect()->route('admin.vehicle.index')->with('msg', "Xóa vĩnh viễn xe $vehicle->so_xe thành công");
    }

    public function statusHoatDong($id) {
        $vehicle = Vehicle::withTrashed()->find($id);
        $vehicle->update(['trang_thai' => 'Hoạt động']);
        return redirect()->back()->with('msg', "Xe $vehicle->so_xe được thay đổi trạng thái thành hoạt động");
    }

    public function statusTamDung($id) {
        $vehicle = Vehicle::withTrashed()->find($id);
        if(!is_null($vehicle->personal_id)){
            return redirect()->back()->with('msg', "Xe $vehicle->so_xe đang được bàn giao. Vui lòng làm biên bản thu hồi!");
        }
        $vehicle->update(['trang_thai' => 'Tạm dừng']);
        return redirect()->back()->with('msg', "Xe $vehicle->so_xe được thay đổi trạng thái thành tạm dừng");
    }

    public function statusSuaChua($id) {
        $vehicle = Vehicle::withTrashed()->find($id);
        $vehicle->update(['trang_thai' => 'Sửa chữa']);
        return redirect()->back()->with('msg', "Xe $vehicle->so_xe được thay đổi trạng thái thành sửa chữa");
    }

    public function importExcelData(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:csv',                
        ],
        [
            'import_file.required' => 'Bắt buộc',
            'import_file.file' => 'Chỉ upload file',
            'import_file.mimes' => 'Upload thất bại! Chỉ up file csv',
        ]);
        Excel::import(new VehicleImport, $request->file('import_file'));

        return redirect()->back()->with('msg', 'Up file thành công');
    }    

    public function exportVehicleData(Request $request){
        $time = Carbon::now()->format('Ymd_His');

        $fileName = "ds_xe_$time.xlsx";

        $vehicles = $this->search($request);

        return Excel::download(new VehicleExport($vehicles), $fileName);
    }

    private function insertData ($request){
        $arrayData = [
            'loai_thung' => $request->loai_thung,
            'may_lanh' => $request->may_lanh,
            'mau_son' => $request->mau_son,
            'nhan_hieu' => $request->nhan_hieu,
            'so_loai' => $request->so_loai,
            'so_may' => $request->so_may,
            'so_khung' => $request->so_khung,
            'nam_sx' => $request->nam_sx,
            'nien_han' => $request->nien_han,
            'cong_thuc_banh_xe' => $request->cong_thuc_banh_xe,
            'kich_thuoc_bao' => $request->kich_thuoc_bao,
            'kich_thuoc_long_thung' => $request->kich_thuoc_long_thung,
            'chieu_dai_co_so' => $request->chieu_dai_co_so,
            'khoi_luong_ban_than' => $request->khoi_luong_ban_than,
            'khoi_luong_hang_hoa' => $request->khoi_luong_hang_hoa,
            'khoi_luong_toan_bo' => $request->khoi_luong_toan_bo,
            'khoi_luong_keo_theo' => $request->khoi_luong_keo_theo,
            'so_nguoi_cho' => $request->so_nguoi_cho,
            'loai_nhien_lieu' => $request->loai_nhien_lieu,
            'hieu_luc_kiem_dinh' => Carbon::createFromFormat('d/m/Y', $request->hieu_luc_kiem_dinh)->format('Y-m-d'),
            'hieu_luc_bhds' => !is_null($request->hieu_luc_bhds) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_bhds)->format('Y-m-d') : null,
            'cong_ty_bhds' => $request->cong_ty_bhds,
            'hieu_luc_bhvc' => !is_null($request->hieu_luc_bhvc) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_bhvc)->format('Y-m-d') : null,
            'cong_ty_bhvc' => $request->cong_ty_bhvc,
            'hieu_luc_ngan_hang' => !is_null($request->hieu_luc_ngan_hang) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_ngan_hang)->format('Y-m-d') : null,
            'unit_id' => $request->unit_id,
            'dinh_muc_tb' => $request->dinh_muc_tb,
            'dinh_muc_thay_nhot' => $request->dinh_muc_thay_nhot,
            'ngay_mua' => Carbon::createFromFormat('d/m/Y', $request->ngay_mua)->format('Y-m-d'),
        ];
        return $arrayData;
    }

    private function storeImage1(Request $request) {
        $fileName = null;
        if($request->hasFile('image_url_1')){
            $originName = $request->file('image_url_1')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image_url_1')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '_' . $extension;
            $request->file('image_url_1')->move(public_path('image'), $fileName);
        }
        return $fileName;
    }

    private function storeImage2(Request $request) {
        $fileName = null;
        if($request->hasFile('image_url_2')){
            $originName = $request->file('image_url_2')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image_url_2')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '_' . $extension;
            $request->file('image_url_2')->move(public_path('image'), $fileName);
        }
        return $fileName;
    }

}
