<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Supplier;
use App\Models\administrator\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::with('supplier')->get();
        if(Auth::user()->role == 1){
            $warehouses = Warehouse::with('supplier')->withTrashed()->get();
        }
        
        return view('administrator.pages.warehouse.index')->with('warehouses', $warehouses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('administrator.pages.warehouse.create')->with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Warehouse::create([
            'the_loai' => $request->the_loai,
            'ma_vat_tu' => $request->ma_vat_tu,
            'vat_tu' => $request->vat_tu,
            'don_vi_tinh' => $request->don_vi_tinh
        ]);
        return redirect()->route('admin.warehouse.index')->with('msg', "Thêm vật tư $request->vat_tu thành công");
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
    public function edit(string $ma_vat_tu)
    {

        $suppliers = Supplier::all();
        $warehouse = Warehouse::where('ma_vat_tu', $ma_vat_tu)->first();
        return view('administrator.pages.warehouse.detail')
        ->with('warehouse', $warehouse)
        ->with('suppliers', $suppliers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warehouse = Warehouse::find($id);
        $arrayData =[
            'the_loai' => $request->the_loai,
            'ma_vat_tu' => $request->ma_vat_tu,
            'vat_tu' => $request->vat_tu,
            'don_vi_tinh' => $request->don_vi_tinh
        ];
        $warehouse->update($arrayData);
        return redirect()->route('admin.warehouse.index')->with('msg', "Cập nhật vật tư $request->vat_tu thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
        return redirect()->route('admin.warehouse.index')->with('msg', "Xóa vật tư $warehouse->vat_tu thành công");
    }

    public function restore($id) {
        $warehouse = Warehouse::withTrashed()->find($id);
        $warehouse->restore();
        return redirect()->route('admin.warehouse.index')->with('msg', "Khôi phục thông tin $warehouse->vat_tu thành công");
    }

    public function forceDelete($id) {
        $warehouse = Warehouse::withTrashed()->find($id);
        $warehouse->forceDelete();
        return redirect()->route('admin.warehouse.index')->with('msg', "Xóa vật tư $warehouse->vat_tu khỏi hệ thành công");
    }
}
