<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Maintenance;
use App\Models\administrator\Vihicle;
use App\Models\administrator\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with('vihicle')
        ->with('warehouse')
        ->orderBy('ngay_thuc_hien', 'DESC')
        ->get();
        if(Auth::user()->role == 1){
            $maintenances = Maintenance::with('vihicle')
            ->with('warehouse')
            ->withTrashed()
            ->orderBy('ngay_thuc_hien', 'DESC')
            ->get();
        }
        return view('administrator.pages.maintenance.index')->with('maintenances', $maintenances);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = Warehouse::where('the_loai', 0)->get();
        $vihicles = Vihicle::all();
        return view('administrator.pages.maintenance.create')
        ->with('warehouses', $warehouses)
        ->with('vihicles', $vihicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $warehouse = Warehouse::find($request->warehouse_id);
        if($warehouse->ton_kho < $request->so_luong){
            return redirect()->route('admin.maintenance.create')->with('msg', 'Số lượng xuất lớn hơn số lượng tồn kho, vui lòng kiểm tra lại');
        }
        $thanh_tien = $request->so_luong * $warehouse->don_gia;
        $ngay_thuc_hien = Carbon::createFromFormat('d/m/Y', $request->ngay_thuc_hien)->format('Y-m-d');
        Maintenance::create([
            'odo' => $request->odo,
            'ngay_thuc_hien' => $ngay_thuc_hien,
            'so_luong' => $request->so_luong,
            'don_gia' => $warehouse->don_gia,
            'thanh_tien' => $thanh_tien,
            'vihicle_id' => $request->vihicle_id,
            'warehouse_id' => $request->warehouse_id,
            'seri' => $request->seri
        ]);

        $warehouse->tong_xuat += $request->so_luong;
        $warehouse->ton_kho -= $request->so_luong;
        $warehouse->save();

        return redirect()->route('admin.maintenance.create')->with('msg', 'Lưu thông tin bảo dưỡng - sửa chữa thành công');
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
        $vihicles = Vihicle::all();
        return view('administrator.pages.maintenance.detail')
        ->with('maintenance', $maintenance)
        ->with('warehouses', $warehouses)
        ->with('vihicles', $vihicles);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
            'vihicle_id' => $request->vihicle_id,
            'warehouse_id' => $request->warehouse_id,
            'seri' => $request->seri
        ];

        $maintenance->update($arrayData);

        $warehouse->tong_xuat += $request->so_luong;
        $warehouse->ton_kho -= $request->so_luong;
        $warehouse->save();

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
