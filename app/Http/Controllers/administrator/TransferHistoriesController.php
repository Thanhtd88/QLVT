<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\administrator\TransferHistories\StoreRequest;
use App\Models\administrator\Personal;
use App\Models\administrator\TransferHistories;
use App\Models\administrator\Vehicle;
use App\Models\administrator\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TransferHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $transfers = $this->search($request);   
        return view('administrator.pages.transferhistories.index')->with('transfers', $transfers);
    }

    private function search(Request $request) {
        $keyword = $request->keyword ?? '';
        $keyword = '%'.$keyword.'%';
        $transfers = TransferHistories::withTrashed(Auth::user()->role == 1 ? true : false)
        ->with('personal')
        ->with('vehicle')
        ->where('tai_xe', 'like', $keyword)
        ->orWhere('so_xe', 'like', $keyword)
        ->orderBy('created_at', 'DESC')
        ->paginate(config('my-config.item_per_page'));

        return $transfers;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $time = Carbon::now()->format("d/m/Y");
        $vehicles = Vehicle::all();
        $personals = Personal::all();
        $warehouses = Warehouse::where('the_loai', 1)->get();
        $maxId = TransferHistories::withTrashed()->max('id');
        return view('administrator.pages.transferhistories.create', compact('personals', 'vehicles', 'warehouses', 'time', 'maxId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        
        if($request->loai_bien_ban == 0){
            $ma_ten = $request->r_personal_id;
        }else{
            $ma_ten = $request->d_personal_id;
        }
        
        $array = explode(' ', $ma_ten);
        $personal = Personal::where('ma_nv', array_shift($array))->first();
        $tai_co_xe = $personal->vehicle_id;
        $vehicle = Vehicle::where('so_xe', $request->vehicle_id)->first();
        $xe_co_tai = $vehicle->personal_id;
        
        if($request->loai_bien_ban == 0){
            if(!is_null($tai_co_xe)){
                $vehicle_cu = Vehicle::find($tai_co_xe);
                return redirect()->back()->with('msg', "Tài xế $ma_ten đã được bàn giao xe $vehicle_cu->so_xe vui lòng kiểm tra lại");
            }else if(!is_null($xe_co_tai)){
                $personal_cu = Personal::find($xe_co_tai);
                return redirect()->back()->with('msg', "Xe $request->vehicle_id đã được bàn giao cho tài xế $personal_cu->ho_ten vui lòng kiểm tra lại");
            }
        }else{
            if(is_null($tai_co_xe) || $tai_co_xe !== $vehicle->id){
                return redirect()->back()->with('msg', "Tài xế $ma_ten chưa được bàn giao xe $request->vehicle_id vui lòng kiểm tra lại");
            }
        }
        
        $arrayData = [
            'so_bien_ban' => $request->so_bien_ban,
            'loai_bien_ban' => $request->loai_bien_ban,
            'ngay_ban_giao' => !is_null($request->ngay_ban_giao) ? Carbon::createFromFormat('d/m/Y', $request->ngay_ban_giao)->format('Y-m-d') : null,
            'tinh_trang_xe' => $request->tinh_trang_xe,
            'personal_id' => $personal->id,
            'vehicle_id' => $vehicle->id,
            'tai_xe' => $request->personal_id,
            'so_xe' => $request->vehicle_id
        ];
        TransferHistories::create($arrayData);
        
        if($request->loai_bien_ban == 0){
            $personal->vehicle_id = $vehicle->id;
            $personal->save();

            $vehicle->personal_id = $personal->id;
            $vehicle->save();
        }else{
            $personal->vehicle_id = null;
            $personal->save();
            
            $vehicle->personal_id = null;
            $vehicle->save();
        }
        
        return redirect()->route('admin.transfer.index')->with('msg', "Lưu thông tin bàn giao thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('administrator.pages.transferhistories.form');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function printer(){
        return view('administrator.pages.transferhistories.printer');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $transfer = TransferHistories::find($id);
        $ngay_moi_nhat = TransferHistories::where('personal_id', $transfer->personal_id)->orderBy('ngay_ban_giao', 'DESC')->first();
        $transfer->delete();
        
        $vehicle = Vehicle::find($transfer->vehicle_id);
        $personal = Personal::find($transfer->personal_id);
        if($transfer->ngay_ban_giao == $ngay_moi_nhat->ngay_ban_giao){
            if($transfer->loai_bien_ban == 0){
                
                $personal->vehicle_id = null;
                $personal->save();
                $vehicle->personal_id = null;
                $vehicle->save();
            }else{
                $personal->vehicle_id = $transfer->vehicle_id;
                $personal->save();
                $vehicle->personal_id = $transfer->vehicle_id;
                $vehicle->save();
            }
        }

        return redirect()->route('admin.transfer.index')->with('msg', "Xóa thành công");
    }

    public function restore($id) {
        $transfer = TransferHistories::withTrashed()->find($id);
        $transfer->restore();

        $ngay_moi_nhat = TransferHistories::where('personal_id', $transfer->personal_id)->orderBy('ngay_ban_giao', 'DESC')->first();
        $vehicle = Vehicle::find($transfer->vehicle_id);
        $personal = Personal::find($transfer->personal_id);

        if($transfer->ngay_ban_giao == $ngay_moi_nhat->ngay_ban_giao){
            if($transfer->loai_bien_ban == 0){
                $personal->vehicle_id = $transfer->vehicle_id;
                $personal->save();
                $vehicle->personal_id = $transfer->vehicle_id;
                $vehicle->save();
            }else{
                $personal->vehicle_id = null;
                $personal->save();
                $vehicle->personal_id = null;
                $vehicle->save();
            }
        }

        return redirect()->route('admin.transfer.index')->with('msg', "Khôi phục thành công");
    }

    public function forceDelete($id) {
        $transfer = TransferHistories::withTrashed()->find($id);
        $transfer->forceDelete();
        return redirect()->route('admin.transfer.index')->with('msg', "Xóa khỏi hệ thành công");
    }

    
}
