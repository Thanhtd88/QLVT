<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\administrator\TransferHistories\StoreRequest;
use App\Models\administrator\Personal;
use App\Models\administrator\TransferHistories;
use App\Models\administrator\Vihicle;
use App\Models\administrator\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;
use function PHPUnit\Framework\isNull;

class TransferHistoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $keyword = $request->keyword ?? '';
        // $keyword = '%'.$keyword.'%';
        // $sort = $request->sort ?? 'Mới nhất';
        // $direction = $sort === 'Mới nhất' ? "DESC" : "ASC";
        // $transfers = TransferHistories::withTrashed()
        //     ->with('personal')
        //     ->with('vihicle')
        //     ->where('tai_xe', 'like', $keyword)
        //     ->orWhere('so_xe', 'like', $keyword)
        //     ->orderBy('created_at', $direction)
        //     ->paginate(10);

        $transfers = TransferHistories::with('personal')
        ->with('vihicle')
        ->get();
        if(Auth::user()->role == 1){
            $transfers = TransferHistories::withTrashed()
            ->with('personal')
            ->with('vihicle')
            ->get();
        }
        
        return view('administrator.pages.transferhistories.index')->with('transfers', $transfers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $time = Carbon::now()->format("H:i:s d-m-Y");
        $vihicles = Vihicle::all();
        $personals = Personal::all();
        $warehouses = Warehouse::where('the_loai', 1)->get();
        $maxId = TransferHistories::withTrashed()->max('id');
        return view('administrator.pages.transferhistories.create')
        ->with('personals', $personals)
        ->with('vihicles', $vihicles)
        ->with('warehouses', $warehouses)
        ->with('time', $time)
        ->with('maxId', $maxId);
    }

    public function formVihicle(Request $request)
    {
        $id = $request->vihicle_giao;
        $vihicle = Vihicle::find($id);
        return response()->json([
            'tai_trong' => $vihicle->khoi_luong_hang_hoa,
            'loai_thung' => $vihicle->loai_thung,
            'nhan_hieu' => $vihicle->nhan_hieu,
            'so_khung' => $vihicle->so_khung,
            'so_may' => $vihicle->so_may,
            'nam_sx' => $vihicle->nam_sx
        ]);
    }

    public function formDeliver(Request $request)
    {
        $id = $request->deliver;
        $personal = Personal::find($id);
        $dob = date('d-m-Y', strtotime($personal->ngay_sinh));
        $cccd_date = date('d-m-Y', strtotime($personal->ngay_cap_cccd));
        $gplx_date = is_null($personal->ngay_cap_gplx) ? null : date('d-m-Y', strtotime($personal->ngay_cap_gplx));
        return response()->json([
            'ngay_sinh' => $dob,
            'dia_chi' => $personal->dia_chi,
            'sdt' => $personal->sdt,
            'cccd' => $personal->cccd,
            'gplx' => $personal->gplx,
            'ngay_cap_cccd' => $cccd_date,
            'noi_cap_cccd' => $personal->noi_cap_cccd,
            'ngay_cap_gplx' => $gplx_date,
            'noi_cap_gplx' => $personal->noi_cap_gplx,
            'hang_gplx' => $personal->hang_gplx,
        ]);
    }

    public function formReceiver(Request $request)
    {
        $id = $request->receiver;
        $personal = Personal::find($id);
        $dob = date('d-m-Y', strtotime($personal->ngay_sinh));
        $cccd_date = date('d-m-Y', strtotime($personal->ngay_cap_cccd));
        $gplx_date = is_null($personal->ngay_cap_gplx) ? null : date('d-m-Y', strtotime($personal->ngay_cap_gplx));
        return response()->json([
            'ngay_sinh' => $dob,
            'dia_chi' => $personal->dia_chi,
            'sdt' => $personal->sdt,
            'cccd' => $personal->cccd,
            'gplx' => $personal->gplx,
            'ngay_cap_cccd' => $cccd_date,
            'noi_cap_cccd' => $personal->noi_cap_cccd,
            'ngay_cap_gplx' => $gplx_date,
            'noi_cap_gplx' => $personal->noi_cap_gplx,
            'hang_gplx' => $personal->hang_gplx,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        
        if($request->loai_bien_ban == 0){
            $personal_id = $request->r_personal_id;
        }else{
            $personal_id = $request->d_personal_id;
        }
        
        $personal = Personal::find($personal_id);
        $tai_xe = $personal->ma_nv.'-'.$personal->ho_ten;
        $tai_co_xe = $personal->vihicle_id;
        $vihicle = Vihicle::find($request->vihicle_id);
        $so_xe = $vihicle->so_xe; 
        $xe_co_tai = $vihicle->personal_id;
        
        if($request->loai_bien_ban == 0){
            if(!is_null($tai_co_xe)){
                $vihicle_cu = Vihicle::find($tai_co_xe);
                return redirect()->back()->with('msg', "Tài xế $tai_xe đã được bàn giao xe $vihicle_cu->so_xe vui lòng kiểm tra lại");
            }else if(!is_null($xe_co_tai)){
                $personal_cu = Personal::find($xe_co_tai);
                return redirect()->back()->with('msg', "Xe $so_xe đã được bàn giao cho tài xế $personal_cu->ho_ten vui lòng kiểm tra lại");
            }
        }else{
            if(is_null($tai_co_xe) || $tai_co_xe !== $request->vihicle_id){
                return redirect()->back()->with('msg', "Tài xế $tai_xe chưa được bàn giao xe $so_xe vui lòng kiểm tra lại");
            }
        }
        
        $arrayData = [
            'so_bien_ban' => $request->so_bien_ban,
            'loai_bien_ban' => $request->loai_bien_ban,
            'ngay_ban_giao' => Carbon::now(),
            'tinh_trang_xe' => $request->tinh_trang_xe,
            'personal_id' => $personal_id,
            'vihicle_id' => $request->vihicle_id,
            'tai_xe' => $tai_xe,
            'so_xe' => $so_xe
        ];
        TransferHistories::create($arrayData);
        
        if($request->loai_bien_ban == 0){
            $personal->vihicle_id = $request->vihicle_id;
            $personal->save();

            $vihicle->personal_id = $personal_id;
            $vihicle->save();
        }else{
            $personal->vihicle_id = null;
            $personal->save();
            
            $vihicle->personal_id = null;
            $vihicle->save();
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $transfer = TransferHistories::find($id);
        $ngay_moi_nhat = TransferHistories::where('personal_id', $transfer->personal_id)->orderBy('ngay_ban_giao', 'DESC')->first();
        $transfer->delete();
        
        $vihicle = Vihicle::find($transfer->vihicle_id);
        $personal = Personal::find($transfer->personal_id);
        if($transfer->ngay_ban_giao == $ngay_moi_nhat->ngay_ban_giao){
            if($transfer->loai_bien_ban == 0){
                
                $personal->vihicle_id = null;
                $personal->save();
                $vihicle->personal_id = null;
                $vihicle->save();
            }else{
                $personal->vihicle_id = $transfer->vihicle_id;
                $personal->save();
                $vihicle->personal_id = $transfer->vihicle_id;
                $vihicle->save();
            }
        }

        return redirect()->route('admin.transfer.index')->with('msg', "Xóa thành công");
    }

    public function restore($id) {
        $transfer = TransferHistories::withTrashed()->find($id);
        $transfer->restore();

        $ngay_moi_nhat = TransferHistories::where('personal_id', $transfer->personal_id)->orderBy('ngay_ban_giao', 'DESC')->first();
        $vihicle = Vihicle::find($transfer->vihicle_id);
        $personal = Personal::find($transfer->personal_id);

        if($transfer->ngay_ban_giao == $ngay_moi_nhat->ngay_ban_giao){
            if($transfer->loai_bien_ban == 0){
                $personal->vihicle_id = $transfer->vihicle_id;
                $personal->save();
                $vihicle->personal_id = $transfer->vihicle_id;
                $vihicle->save();
            }else{
                $personal->vihicle_id = null;
                $personal->save();
                $vihicle->personal_id = null;
                $vihicle->save();
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
