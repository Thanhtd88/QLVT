<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Diesel\StoreRequest;
use App\Http\Requests\Administrator\Diesel\UpdateRequest;
use App\Models\administrator\Diesel;
use App\Models\administrator\Personal;
use App\Models\administrator\Vehicle;
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
        $diesels = Diesel::with('vehicle')
        ->with('personal')
        ->orderBy('ngay_do', 'desc')
        ->get();
        if(Auth::user()->role == 1){
            $diesels = Diesel::with('vehicle')
            ->orderBy('ngay_do', 'desc')
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
        $vehicles = Vehicle::all();
        $personals = Personal::all();
        return view('administrator.pages.diesel.create')
        ->with('vehicles', $vehicles)
        ->with('personals', $personals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $ngay_truoc = Diesel::where('vehicle_id', $request->vehicle_id)->orderBy('ngay_do', 'desc')->first();        
        $ngay_do = Carbon::createFromFormat('d/m/Y H:i:s', $request->ngay_do)->format('Y-m-d H:i:s');
        // dd($ngay_do);
        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();
        $thanh_tien = $warehouse->don_gia * $request->so_lit;

        $vehicle = Vehicle::find($request->vehicle_id);
        $odo_cu = !is_null($vehicle->odo) ? $vehicle->odo : 0;
        
        if($odo_cu == 0){
            $quang_duong = 0;
            $dinh_muc = 0;
        }else if($odo_cu > $request->odo){
            return redirect()->back()->with('msg', 'Số km mới nhỏ hơn số km cũ. Kiểm tra lại!');
        }else{
            $quang_duong = $request->odo - $odo_cu;
            $so_ngay = floor(abs(strtotime($ngay_do) - strtotime($ngay_truoc->ngay_do)) / (60*60*24));
            if($quang_duong / $so_ngay > 1300){
                return redirect()->back()->with('msg', 'Số km bất thường. Kiểm tra lại số km hoặc số xe!');
            }else{
                $dinh_muc = $request->so_lit / $quang_duong * 100;
            }            
        }

        Diesel::create([
            'odo' => $request->odo,
            'ngay_do' => $ngay_do,
            'noi_do' => $request->noi_do,
            'so_lit' => $request->so_lit,
            'don_gia' => $warehouse->don_gia,
            'thanh_tien' => $thanh_tien,
            'quang_duong' => $quang_duong,
            'dinh_muc' => $dinh_muc,
            'vehicle_id' => $request->vehicle_id,
            'personal_id' => $request->personal_id,
        ]);

        $warehouse->tong_xuat += $request->so_lit;
        $warehouse->ton_kho -= $request->so_lit;
        $warehouse->save();

        $vehicle = Vehicle::find($request->vehicle_id);
        $vehicle->odo = $request->odo;
        $vehicle->save();

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
        $vehicles = Vehicle::all();
        $personals = Personal::all();
        return view('administrator.pages.diesel.detail')
        ->with('vehicles', $vehicles)
        ->with('personals', $personals)
        ->with('diesel', $diesel);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $diesel = Diesel::find($id);
        $vehicle_cu = Vehicle::find($diesel->vehicle_id);
        $vehicle = Vehicle::find($request->vehicle_id);
        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();        
        $ngay_do = Carbon::createFromFormat('d/m/Y H:i:s', $request->ngay_do)->format('Y-m-d H:i:s');

        if($diesel->vehicle_id == $request->vehicle_id && $diesel->so_lit == $request->so_lit && $diesel->odo == $request->odo){
            $arrayData = [
                'ngay_do' => $ngay_do,
                'noi_do' => $request->noi_do,
                'personal_id' => $request->personal_id,
            ];
            $diesel->update($arrayData);
        }else{
            $ngay_truoc = Diesel::where('vehicle_id', $request->vehicle_id)->orderBy('ngay_do', 'desc')->first();       
            // dd($ngay_truoc);
            $thanh_tien = $warehouse->don_gia * $request->so_lit;
            $odo_cu = !is_null($vehicle->odo) ? $vehicle->odo : 0;
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
            if(!is_null($ngay_truoc)){
                $so_ngay = floor(abs(strtotime($request->ngay_do) - strtotime($ngay_truoc->ngay_do)) / (60*60*24));
                
                if($quang_duong / $so_ngay > 1300){
                    return redirect()->back()->with('msg', 'Số km bất thường. Kiểm tra lại số km hoặc số xe!');
                }
            }

            $arrayData = [
                'odo' => $request->odo,
                'ngay_do' => $ngay_do,
                'noi_do' => $request->noi_do,
                'so_lit' => $request->so_lit,
                'don_gia' => $warehouse->don_gia,
                'thanh_tien' => $thanh_tien,
                'quang_duong' => $quang_duong,
                'dinh_muc' => $dinh_muc,
                'vehicle_id' => $request->vehicle_id,
                'personal_id' => $request->personal_id,
            ];

            $diesel->update($arrayData);

            //xóa thông tin cũ trong warehouse và vehicle        
            $warehouse->tong_xuat -= $diesel->so_lit;
            $warehouse->ton_kho += $diesel->so_lit;
            $warehouse->save();

            if($diesel->ngay_do == $request->ngay_do && $diesel->vehicle_id == $request->vehicle_id){
                $vehicle_cu->odo -= $diesel->quang_duong;
                $vehicle_cu->save();
            }
            
            // cập nhật thông tin mới trong warehouse và vehicle
            $warehouse->tong_xuat += $request->so_lit;
            $warehouse->ton_kho -= $request->so_lit;
            $warehouse->save();

            $vehicle->odo = $request->odo;
            $vehicle->save();
        }

        return redirect()->route('admin.diesel.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diesel = Diesel::find($id);
        $ngay_moi = Diesel::where('vehicle_id', $diesel->vehicle_id)->orderBy('ngay_do', 'desc')->first();
        $diesel->delete();

        $warehouse = Warehouse::where('ma_vat_tu', 'DO001')->first();     
        $warehouse->tong_xuat -= $diesel->so_lit;
        $warehouse->ton_kho += $diesel->so_lit;
        $warehouse->save();

        if($diesel->ngay_do == $ngay_moi->ngay_do && $diesel->vehicle_id == $ngay_moi->vehicle_id){
            $vehicle = Vehicle::find($diesel->vehicle_id);
            $vehicle->odo -= $diesel->quang_duong;
            $vehicle->save();
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

        $vehicle = Vehicle::find($diesel->vehicle_id);
        $vehicle->odo = $diesel->odo;
        $vehicle->save();

        return redirect()->route('admin.diesel.index')->with('msg', "Khôi phục thông tin đổ dầu thành công");
    }

    public function forceDelete($id) {
        $diesel = Diesel::withTrashed()->find($id);
        $diesel->forceDelete();
        return redirect()->route('admin.diesel.index')->with('msg', "Xóa thông tin đổ dầu khỏi hệ thành công");
    }
}
