<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Vihicle\StoreRequest;
use App\Http\Requests\Administrator\Vihicle\UpdateRequest;
use App\Models\administrator\Unit;
use App\Models\administrator\Vihicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VihicleController extends Controller
{
    public function index(Request $request)
    {
        // $keyword = $request->keyword ?? '';
        // $keyword = '%'.$keyword.'%';
        // $sort = $request->sort ?? 'Mới nhất';
        // $direction = $sort === 'Mới nhất' ? "DESC" : "ASC";

        $vihicles = Vihicle::with('personal')
        ->with('unit')
        ->orderBy('loai_thung', 'DESC')
        ->orderBy('nhan_hieu', 'DESC')
        ->orderBy('khoi_luong_hang_hoa', 'DESC')
        ->get();
        if(Auth::user()->role == 1){
            $vihicles = Vihicle::with('personal')
            ->with('unit')
            ->withTrashed()
            ->orderBy('loai_thung', 'DESC')
            ->orderBy('nhan_hieu', 'DESC')
            ->orderBy('khoi_luong_hang_hoa', 'DESC')
            ->get();
        }

        // $vihicles = Vihicle::with('personal')->withTrashed()
        // ->where('so_xe', 'like', $keyword)
        // ->orderBy('created_at', $direction)
        // ->paginate(10);
        return view('administrator.pages.vihicle.index')->with('vihicles', $vihicles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        return view('administrator.pages.vihicle.create')
        ->with('units', $units);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $arrayData = [
            'so_xe' => $request->so_xe,
            'loai_thung' => $request->loai_thung,
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
            'hieu_luc_bhds' => Carbon::createFromFormat('d/m/Y', $request->hieu_luc_bhds)->format('Y-m-d'),
            'cong_ty_bhds' => $request->cong_ty_bhds,
            'hieu_luc_bhvc' => !is_null($request->hieu_luc_bhvc) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_bhvc)->format('Y-m-d') : null,
            'cong_ty_bhvc' => $request->cong_ty_bhvc,
            'hieu_luc_ngan_hang' => !is_null($request->hieu_luc_ngan_hang) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_ngan_hang)->format('Y-m-d') : null,
            'unit_id' => $request->unit_id,
            'dinh_muc_tb' => $request->dinh_muc_tb,
            'dinh_muc_thay_nhot' => $request->dinh_muc_thay_nhot,
            'ngay_mua' => Carbon::createFromFormat('d/m/Y', $request->ngay_mua)->format('Y-m-d'),
            'ngay_ban' => !is_null($request->ngay_ban) ? Carbon::createFromFormat('d/m/Y', $request->ngay_mua)->format('Y-m-d') : null,
            'trang_thai' => $request->trang_thai
        ];
        
        Vihicle::create($arrayData);
        
        return redirect()->route('admin.vihicle.index')->with('msg', "Thêm xe $request->so_xe thành công");
    }

    public function show(string $so_xe)
    {
        $units = Unit::all();
        $vihicles = Vihicle::where('so_xe', $so_xe)->first();
        return view('administrator.pages.vihicle.info')
        ->with('units', $units)
        ->with('vihicles', $vihicles);   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $so_xe)
    {
        $units = Unit::all();
        $vihicle = Vihicle::where('so_xe', $so_xe)->first();
        return view('administrator.pages.vihicle.detail')
        ->with('units', $units)
        ->with('vihicle', $vihicle);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $vihicle = Vihicle::find($id);
        $arrayData = [
            'so_xe' => $request->so_xe,
            'loai_thung' => $request->loai_thung,
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
            'hieu_luc_bhds' => Carbon::createFromFormat('d/m/Y', $request->hieu_luc_bhds)->format('Y-m-d'),
            'cong_ty_bhds' => $request->cong_ty_bhds,
            'hieu_luc_bhvc' => !is_null($request->hieu_luc_bhvc) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_bhvc)->format('Y-m-d') : null,
            'cong_ty_bhvc' => $request->cong_ty_bhvc,
            'hieu_luc_ngan_hang' => !is_null($request->hieu_luc_ngan_hang) ? Carbon::createFromFormat('d/m/Y', $request->hieu_luc_ngan_hang)->format('Y-m-d') : null,
            'unit_id' => $request->unit_id,
            'dinh_muc_tb' => $request->dinh_muc_tb,
            'dinh_muc_thay_nhot' => $request->dinh_muc_thay_nhot,
            'ngay_mua' => Carbon::createFromFormat('d/m/Y', $request->ngay_mua)->format('Y-m-d'),
            'ngay_ban' => !is_null($request->ngay_ban) ? Carbon::createFromFormat('d/m/Y', $request->ngay_mua)->format('Y-m-d') : null,
            'trang_thai' => $request->trang_thai
        ];
        $vihicle->update($arrayData);
        return redirect()->route('admin.vihicle.index')->with('msg', "Cập nhật xe $request->so_xe thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vihicle = Vihicle::find($id);
        $vihicle->delete();
        return redirect()->route('admin.vihicle.index')->with('msg', "Xóa xe $vihicle->so_xe thành công");
    }

    public function restore($id) {
        $vihicle = Vihicle::withTrashed()->find($id);
        $vihicle->restore();
        return redirect()->route('admin.vihicle.index')->with('msg', "Khôi phục thông tin xe $vihicle->so_xe thành công");
    }

    public function forceDelete($id) {
        $vihicle = Vihicle::withTrashed()->find($id);
        $vihicle->forceDelete();
        return redirect()->route('admin.vihicle.index')->with('msg', "Xóa khỏi xe $vihicle->so_xe hệ thành công");
    }
}
