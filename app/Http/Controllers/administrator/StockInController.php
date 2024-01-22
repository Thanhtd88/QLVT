<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\StockIn;
use App\Models\administrator\Supplier;
use App\Models\administrator\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock_ins = StockIn::with('supplier')
        ->with('warehouse')
        ->orderBy('ngay_nhap_kho', 'DESC')
        ->get();
        if(Auth::user()->role == 1){
            $stock_ins = StockIn::withTrashed()
            ->with('supplier')
            ->with('warehouse')
            ->orderBy('ngay_nhap_kho', 'DESC')
            ->get();
        }
        
        return view('administrator.pages.stockin.index')->with('stock_ins', $stock_ins);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        return view('administrator.pages.stockin.create')
        ->with('warehouses', $warehouses)
        ->with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ngay_nhap_kho = Carbon::createFromFormat('d/m/Y', $request->ngay_nhap_kho)->format('Y-m-d');
        $warehouse = Warehouse::find($request->warehouse_id);
        $chenh_lech_gia = $request->don_gia_nhap - $warehouse->don_gia;
        // dd($chenh_lech_gia);
        StockIn::create([
            'ngay_nhap_kho' => $ngay_nhap_kho,
            'warehouse_id' => $request->warehouse_id,
            'so_luong_nhap' => $request->so_luong_nhap,
            'don_gia_nhap' => $request->don_gia_nhap,
            'supplier_id' => $request->supplier_id,
            'chenh_lech_gia' => $chenh_lech_gia
        ]);
        
        
        $warehouse->tong_nhap += $request->so_luong_nhap;
        $warehouse->ton_kho += $request->so_luong_nhap;
        $warehouse->don_gia = $request->don_gia_nhap;
        $warehouse->save();

        return redirect()->route('admin.stock-in.index')->with('msg', 'Thêm thông tin nhập hàng thành công');
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
        $warehouses = Warehouse::all();
        $suppliers = Supplier::all();
        $stock_in = StockIn::find($id);
        return view('administrator.pages.stockin.detail')
        ->with('warehouses', $warehouses)
        ->with('suppliers', $suppliers)
        ->with('stock_in', $stock_in);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stock_in = StockIn::find($id);
        $warehouse = Warehouse::find($request->warehouse_id);
        $chenh_lech_gia = $request->don_gia_nhap - ($warehouse->don_gia - $stock_in->chenh_lech_gia );
        $so_luong_cu = $stock_in->so_luong_nhap;
        $ngay_nhap_kho = Carbon::createFromFormat('d/m/Y', $request->ngay_nhap_kho)->format('Y-m-d');
        $arrayData = [
            'ngay_nhap_kho' => $ngay_nhap_kho,
            'warehouse_id' => $request->warehouse_id,
            'so_luong_nhap' => $request->so_luong_nhap,
            'don_gia_nhap' => $request->don_gia_nhap,
            'supplier_id' => $request->supplier_id,
            'chenh_lech_gia' => $chenh_lech_gia
        ];
        $stock_in->update($arrayData);
                
        $warehouse->tong_nhap -= $so_luong_cu;
        $warehouse->tong_nhap += $request->so_luong_nhap;
        $warehouse->ton_kho -= $so_luong_cu;
        $warehouse->ton_kho += $request->so_luong_nhap;
        $warehouse->don_gia = $request->don_gia_nhap;
        $warehouse->save();

        return redirect()->route('admin.stock-in.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stock_in = StockIn::find($id);
        $stock_in->delete();

        $warehouse = Warehouse::find($stock_in->warehouse_id);        
        $warehouse->tong_nhap -= $stock_in->so_luong_nhap;
        $warehouse->ton_kho -= $stock_in->so_luong_nhap;
        $warehouse->don_gia -= $stock_in->chenh_lech_gia;
        $warehouse->save();

        return redirect()->route('admin.stock-in.index')->with('msg', "Xóa thông tin nhập hàng ngày $stock_in->ngay_nhap_kho thành công");
    }

    public function restore($id) {
        $stock_in = StockIn::withTrashed()->find($id);
        $stock_in->restore();

        $warehouse = Warehouse::find($stock_in->warehouse_id);        
        $warehouse->tong_nhap += $stock_in->so_luong_nhap;
        $warehouse->ton_kho += $stock_in->so_luong_nhap;
        $warehouse->don_gia += $stock_in->chenh_lech_gia;
        $warehouse->save();

        return redirect()->route('admin.stock-in.index')->with('msg', "Khôi phục thông tin nhập hàng ngày $stock_in->ngay_nhap_kho thành công");
    }

    public function forceDelete($id) {
        $stock_in = StockIn::withTrashed()->find($id);
        $stock_in->forceDelete();
        return redirect()->route('admin.stock-in.index')->with('msg', "Xóa thông tin nhập hàng ngày $stock_in->ngay_nhap_kho khỏi hệ thành công");
    }
}
