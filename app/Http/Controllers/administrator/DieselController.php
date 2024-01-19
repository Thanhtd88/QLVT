<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Diesel;
use App\Models\administrator\Personal;
use App\Models\administrator\Vihicle;
use App\Models\administrator\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DieselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diesels = Diesel::with('vihicle')
        ->with('personal')
        ->get();
        if(Auth::user()->role == 1){
            $diesels = Diesel::with('vihicle')
            ->with('personal')
            ->withTrashed()
            ->get();
        }
        return view('administrator.pages.diesel.index')->with('diesels', $diesels);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vihicles = Vihicle::all();
        $personals = Personal::all();
        return view('administrator.pages.diesel.create')
        ->with('vihicles', $vihicles)
        ->with('personals', $personals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ngay_truoc = Diesel::where('vihicle_id', $request->vihicle_id)->orderBy('ngay_do', 'desc')->first();
        $so_ngay = floor(abs(strtotime($request->ngay_do) - strtotime($ngay_truoc->ngay_do)) / (60*60*24));

        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();
        $thanh_tien = $warehouse->don_gia * $request->so_lit;
        $vihicle = Vihicle::find($request->vihicle_id);
        $odo_cu = !is_null($vihicle->odo) ? $vihicle->odo : 0;
        if($request->odo < $odo_cu){
            return redirect()->back()->with('msg', 'Số km mới nhỏ hơn số km cũ. Kiểm tra lại!');
        }
        if($odo_cu == 0){
            $quang_duong = 0;
            $dinh_muc = 0;
        }else{
            $quang_duong = $request->odo - $odo_cu;
            $dinh_muc = $request->so_lit / $quang_duong * 100;
        }
        
        if($quang_duong / $so_ngay > 1300){
            return redirect()->back()->with('msg', 'Số km bất thường. Kiểm tra lại số km hoặc số xe!');
        }
        $ngay_do = Carbon::createFromFormat('d/m/Y', $request->ngay_do)->format('Y-m-d');
        Diesel::create([
            'odo' => $request->odo,
            'ngay_do' => $request->ngay_do,
            'noi_do' => $request->noi_do,
            'so_lit' => $request->so_lit,
            'don_gia' => $warehouse->don_gia,
            'thanh_tien' => $thanh_tien,
            'quang_duong' => $quang_duong,
            'dinh_muc' => $dinh_muc,
            'vihicle_id' => $request->vihicle_id,
            'personal_id' => $request->personal_id,
        ]);

        $warehouse->tong_xuat += $request->so_lit;
        $warehouse->ton_kho -= $request->so_lit;
        $warehouse->save();

        $vihicle = Vihicle::find($request->vihicle_id);
        $vihicle->odo = $request->odo;
        $vihicle->save();

        return redirect()->route('admin.diesel.index')->with('msg', 'Thêm thông tin xe đổ dầu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $diesel = Diesel::find($id);
        $vihicles = Vihicle::all();
        $personals = Personal::all();
        return view('administrator.pages.diesel.detail')
        ->with('vihicles', $vihicles)
        ->with('personals', $personals)
        ->with('diesel', $diesel);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $diesel = Diesel::find($id);
        $vihicle_cu = Vihicle::find($diesel->vihicle_id);
        $vihicle = Vihicle::find($request->vihicle_id);
        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();
        

        $ngay_truoc = Diesel::where('vihicle_id', $request->vihicle_id)->orderBy('ngay_do', 'desc')->first();
        $so_ngay = floor(abs(strtotime($request->ngay_do) - strtotime($ngay_truoc->ngay_do)) / (60*60*24));
        
        
        $thanh_tien = $warehouse->don_gia * $request->so_lit;
        $odo_cu = !is_null($vihicle->odo) ? $vihicle->odo : 0;
        if($request->odo < $odo_cu){
            return redirect()->back()->with('msg', 'Số km mới nhỏ hơn số km cũ. Kiểm tra lại!');
        }
        if($odo_cu == 0){
            $quang_duong = 0;
            $dinh_muc = 0;
        }else{
            $quang_duong = $request->odo - $odo_cu;
            $dinh_muc = $request->so_lit / $quang_duong * 100;
        }
        
        if($quang_duong / $so_ngay > 1300){
            return redirect()->back()->with('msg', 'Số km bất thường. Kiểm tra lại số km hoặc số xe!');
        }
        $ngay_do = Carbon::createFromFormat('d/m/Y', $request->ngay_do)->format('Y-m-d');
        $arrayData = [
            'odo' => $request->odo,
            'ngay_do' => $ngay_do,
            'noi_do' => $request->noi_do,
            'so_lit' => $request->so_lit,
            'don_gia' => $warehouse->don_gia,
            'thanh_tien' => $thanh_tien,
            'quang_duong' => $quang_duong,
            'dinh_muc' => $dinh_muc,
            'vihicle_id' => $request->vihicle_id,
            'personal_id' => $request->personal_id,
        ];

        $diesel->update($arrayData);

        // xóa thông tin cũ trong warehouse và vihicle        
        $warehouse->tong_xuat -= $diesel->so_lit;
        $warehouse->ton_kho += $diesel->so_lit;
        $warehouse->save();

        if($diesel->ngay_do == $request->ngay_do && $diesel->vihicle_id == $request->vihicle_id){
            $vihicle_cu->odo -= $diesel->quang_duong;
            $vihicle_cu->save();
        }
        
        // cập nhật thông tin mới trong warehouse và vihicle
        $warehouse->tong_xuat += $request->so_lit;
        $warehouse->ton_kho -= $request->so_lit;
        $warehouse->save();

        $vihicle->odo = $request->odo;
        $vihicle->save();

        return redirect()->route('admin.diesel.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diesel = Diesel::find($id);
        $diesel->delete();

        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();     
        $warehouse->tong_xuat -= $diesel->so_lit;
        $warehouse->ton_kho += $diesel->so_lit;
        $warehouse->save();

        $ngay_moi = Diesel::where('vihicle_id', $diesel->vihicle_id)->orderBy('ngay_do', 'desc')->first();
        if($diesel->ngay_do == $ngay_moi->ngay_do && $diesel->vihicle_id == $ngay_moi->vihicle_id){
            $vihicle = Vihicle::find($diesel->vihicle_id);
            $vihicle->odo -= $diesel->quang_duong;
            $vihicle->save();
        }        

        return redirect()->route('admin.diesel.index')->with('msg', "Xóa thông tin đổ dầu thành công");
    }

    public function restore($id) {
        $diesel = Diesel::withTrashed()->find($id);
        $diesel->restore();

        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();     
        $warehouse->tong_xuat += $diesel->so_lit;
        $warehouse->ton_kho -= $diesel->so_lit;
        $warehouse->save();

        $vihicle = Vihicle::find($diesel->vihicle_id);
        $vihicle->odo = $diesel->odo;
        $vihicle->save();

        return redirect()->route('admin.diesel.index')->with('msg', "Khôi phục thông tin đổ dầu thành công");
    }

    public function forceDelete($id) {
        $diesel = Diesel::withTrashed()->find($id);
        $diesel->forceDelete();
        return redirect()->route('admin.diesel.index')->with('msg', "Xóa thông tin đổ dầu khỏi hệ thành công");
    }
}
