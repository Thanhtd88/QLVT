<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Maintenance\StoreRequest;
use App\Http\Requests\Administrator\Maintenance\UpdateRequest;
use App\Models\administrator\Maintenance;
use App\Models\administrator\Vehicle;
use App\Models\administrator\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $warehouses = Warehouse::where('the_loai', 0)->get();
        $vehicles = Vehicle::all();
        $maintenances = $this->search($request);
        return view('administrator.pages.maintenance.index', compact('maintenances', 'vehicles', 'warehouses'));
    }

    private function search(Request $request) {        
        $vehicle = Vehicle::where('so_xe', $request->so_xe)->first();
        $warehouse = Warehouse::where('vat_tu', $request->vat_tu)->first();
        $so_xe = $vehicle ? $vehicle->id : '';
        $so_xe = '%'.$so_xe.'%';
        $vat_tu = $warehouse ? $warehouse->id : '%%';
        $loai = $request->loai;
        $loai = '%'.$loai.'%';
        if(!is_null($request->khoang_thoi_gian)){
            $array = explode(' ', $request->khoang_thoi_gian);        
            $ngay_bat_dau = Carbon::createFromFormat('d/m/Y', array_shift($array))->format('Y-m-d');
            $ngay_ket_thuc = Carbon::createFromFormat('d/m/Y', array_pop($array))->format('Y-m-d');
        }
        $maintenances = Maintenance::with('vehicle')
        ->with('warehouse')
        ->where('loai','like', $loai)
        ->where('vehicle_id','like', $so_xe)
        ->where('warehouse_id','like', $vat_tu)
        ->where('ngay_thuc_hien', !is_null($request->khoang_thoi_gian) ? '>=' : 'like', !is_null($request->khoang_thoi_gian) ? $ngay_bat_dau : "%")
        ->where('ngay_thuc_hien', !is_null($request->khoang_thoi_gian) ? '<=' : 'like', !is_null($request->khoang_thoi_gian) ? $ngay_ket_thuc : "%")
        ->withTrashed(Auth::user()->role == 1 ? true : false)
        ->orderBy('ngay_thuc_hien', 'DESC')
        ->get();

        return $maintenances;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = Warehouse::where('the_loai', 0)->get();
        $vehicles = Vehicle::all();
        return view('administrator.pages.maintenance.create')
        ->with('warehouses', $warehouses)
        ->with('vehicles', $vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $vehicle_id = Vehicle::where('so_xe', $request->vehicle_id)->first();
        $warehouse_id = Warehouse::where('vat_tu', $request->warehouse_id);
        $warehouse = Warehouse::find($warehouse_id);
        if($warehouse->ton_kho < $request->so_luong){
            return redirect()->back()->with('msg', 'Số lượng xuất lớn hơn số lượng tồn kho, vui lòng kiểm tra lại');
        }
        if($warehouse_id == 3 || $warehouse_id == 4 && is_null($request->odo)){
            return redirect()->back()->with('msg', 'Xe thay nhớt phải nhập số km! Kiểm tra lại');
        }

        $thanh_tien = $request->so_luong * $warehouse->don_gia;
        $ngay_thuc_hien = Carbon::createFromFormat('d/m/Y', $request->ngay_thuc_hien)->format('Y-m-d');
        Maintenance::create([
            'odo' => $request->odo,
            'ngay_thuc_hien' => $ngay_thuc_hien,
            'so_luong' => $request->so_luong,
            'don_gia' => $warehouse->don_gia,
            'thanh_tien' => $thanh_tien,
            'vehicle_id' => $vehicle_id,
            'warehouse_id' => $warehouse_id,
            'seri' => $request->seri,
            'loai' => $request->loai
        ]);

        $warehouse->tong_xuat += $request->so_luong;
        $warehouse->ton_kho -= $request->so_luong;
        $warehouse->save();

        if($warehouse_id == 3 || $warehouse_id == 4){
            $vehicle = Vehicle::find($vehicle_id);
            $vehicle->odo_thay_nhot = $request->odo;
            $vehicle->save();
        }

        return redirect()->route('admin.maintenance.create')->with('msg', 'Lưu thông tin thành công');
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
        $maintenance = Maintenance::find($id);
        $warehouses = Warehouse::where('the_loai', 0)->get();
        $vehicles = Vehicle::all();
        return view('administrator.pages.maintenance.detail')
        ->with('maintenance', $maintenance)
        ->with('warehouses', $warehouses)
        ->with('vehicles', $vehicles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $maintenance = Maintenance::find($id);
        $warehouse = Warehouse::find($maintenance->warehouse_id);
        $warehouse->tong_xuat -= $maintenance->so_luong;
        $warehouse->ton_kho += $maintenance->so_luong;
        $warehouse->save();

        $warehouse = Warehouse::find($request->warehouse_id);
        if($warehouse->ton_kho < $request->so_luong){
            return redirect()->route('admin.maintenance.create')->with('msg', 'Số lượng xuất lớn hơn số lượng tồn kho, vui lòng kiểm tra lại');
        }
        $thanh_tien = $request->so_luong * $warehouse->don_gia;
        $ngay_thuc_hien = Carbon::createFromFormat('d/m/Y', $request->ngay_thuc_hien)->format('Y-m-d');
        $arrayData = [
            'odo' => $request->odo,
            'ngay_thuc_hien' => $ngay_thuc_hien,
            'so_luong' => $request->so_luong,
            'don_gia' => $warehouse->don_gia,
            'thanh_tien' => $thanh_tien,
            'vehicle_id' => $request->vehicle_id,
            'warehouse_id' => $request->warehouse_id,
            'seri' => $request->seri,
            'loai' => $request->loai
        ];

        $maintenance->update($arrayData);

        $warehouse->tong_xuat += $request->so_luong;
        $warehouse->ton_kho -= $request->so_luong;
        $warehouse->save();

        if($request->warehouse_id == 3 || $request->warehouse_id == 4){
            $vehicle = Vehicle::find($request->vehicle_id);
            $vehicle->odo_thay_nhot = $request->odo;
            $vehicle->save();
        }

        return redirect()->route('admin.maintenance.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maintenance = Maintenance::find($id);
        $warehouse = Warehouse::find($maintenance->warehouse_id);  
        $maintenance->delete();
           
        $warehouse->tong_xuat -= $maintenance->so_luong;
        $warehouse->ton_kho += $maintenance->so_luong;
        $warehouse->save();

        if($maintenance->warehouse_id == 3 || $maintenance->warehouse_id == 4){
            $vehicle = Vehicle::find($maintenance->vehicle_id);
            // $vehicle->odo_thay_nhot = $maintenance->odo;
            // $vehicle->save();
        }

        return redirect()->route('admin.maintenance.index')->with('msg', "Xóa thông tin thành công");
    }

    public function restore($id) {
        $maintenance = Maintenance::withTrashed()->find($id);
        $maintenance->restore();

        $warehouse = Warehouse::find($maintenance->warehouse_id);     
        $warehouse->tong_xuat += $maintenance->so_luong;
        $warehouse->ton_kho -= $maintenance->so_luong;
        $warehouse->save();

        return redirect()->route('admin.maintenance.index')->with('msg', "Khôi phục thông tin thành công");
    }

    public function forceDelete($id) {
        $maintenance = Maintenance::withTrashed()->find($id);
        $maintenance->forceDelete();
        return redirect()->route('admin.maintenance.index')->with('msg', "Xóa thông tin khỏi hệ thành công");
    }
}
