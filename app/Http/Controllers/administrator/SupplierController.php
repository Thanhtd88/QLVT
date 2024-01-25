<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Supplier\StoreRequest;
use App\Http\Requests\Administrator\Supplier\UpdateRequest;
use App\Models\administrator\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        if(Auth::user()->role == 1){
            $suppliers = Supplier::withTrashed()->get();
        }
        $suppliers = Supplier::withTrashed()->get();
        return view('administrator.pages.supplier.index')->with('suppliers', $suppliers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.pages.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Supplier::create([
            'ma_ncc' => $request->ma_ncc,
            'ten_ncc' => $request->ten_ncc,
            'dia_chi' => $request->dia_chi,
            'sdt' => $request->sdt,
        ]);
        return redirect()->route('admin.supplier.index')->with('msg', "Thêm nhà cung cấp $request->ten_ncc thành công");
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
    public function edit(string $ma_ncc)
    {
        $supplier = Supplier::where('ma_ncc', $ma_ncc)->first();
        return view('administrator.pages.supplier.detail')->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->update([
            'ma_ncc' => $request->ma_ncc,
            'ten_ncc' => $request->ten_ncc,
            'dia_chi' => $request->dia_chi,
            'sdt' => $request->sdt,
        ]);
        return redirect()->route('admin.supplier.index')->with('msg', "Cập nhật thông tin nha cung cấp $request->ten_ncc thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('admin.supplier.index')->with('msg', "Xóa nhân viên $supplier->ten_ncc thành công");
    }

    public function restore($id) {
        $supplier = Supplier::withTrashed()->find($id);
        $supplier->restore();
        return redirect()->route('admin.supplier.index')->with('msg', "Khôi phục thông tin $supplier->ten_ncc thành công");
    }

    public function forceDelete($id) {
        $supplier = Supplier::withTrashed()->find($id);
        $supplier->forceDelete();
        return redirect()->route('admin.supplier.index')->with('msg', "Xóa nhân viên $supplier->ten_ncc khỏi hệ thành công");
    }
}
