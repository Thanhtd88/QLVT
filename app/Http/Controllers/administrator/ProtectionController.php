<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Protection\StoreRequest;
use App\Http\Requests\Administrator\Protection\UpdateRequest;
use App\Models\administrator\Personal;
use App\Models\administrator\Protection;
use App\Models\administrator\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProtectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $protections = Protection::with('warehouse')
        ->with('personal')
        ->orderBy('ngay_ban_giao', 'DESC')
        ->get();
        if(Auth::user()->role == 1){
            $protections = Protection::with('warehouse')
            ->with('personal')
            ->withTrashed()
            ->orderBy('ngay_ban_giao', 'DESC')
            ->get();
        }
        return view('administrator.pages.protection.index')->with('protections', $protections);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personals = Personal::all();
        $warehouses = Warehouse::where('the_loai', 1)->get();

        return view('administrator.pages.protection.create')
        ->with('personals', $personals)
        ->with('warehouses', $warehouses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $ngay_ban_giao = Carbon::createFromFormat('d/m/Y', $request->ngay_ban_giao)->format('Y-m-d H:i:s');
        Protection::create([
            'ngay_ban_giao' => $ngay_ban_giao,
            'so_luong' => $request->so_luong,
            'personal_id' => $request->personal_id,
            'warehouse_id' => $request->warehouse_id,
        ]);

        $warehouse = Warehouse::find($request->warehouse_id);
        $warehouse->tong_xuat += $request->so_luong;
        $warehouse->ton_kho -= $request->so_luong;
        $warehouse->save();

        return redirect()->route('admin.protection.index')->with('msg', 'Thêm thông tin cấp trang bị thành công');
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
        $personals = Personal::all();
        $warehouses = Warehouse::where('the_loai', 1)->get();
        $protection = Protection::find($id);
        return view('administrator.pages.protection.detail')
        ->with('personals', $personals)
        ->with('warehouses', $warehouses)
        ->with('protection', $protection);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $protection = Protection::find($id);
        $warehouse = Warehouse::find($protection->warehouse_id);
        
        $ngay_ban_giao = Carbon::createFromFormat('d/m/Y', $request->ngay_ban_giao)->format('Y-m-d H:i:s');
        $arrayData = [
            'ngay_ban_giao' => $ngay_ban_giao,
            'so_luong' => $request->so_luong,
            'personal_id' => $request->personal_id,
            'warehouse_id' => $request->warehouse_id,
        ];

        $protection->update($arrayData);

        $warehouse->tong_xuat -= $protection->so_luong;
        $warehouse->ton_kho += $protection->so_luong;
        $warehouse->save();

        $warehouse = Warehouse::find($request->warehouse_id);
        $warehouse->tong_xuat += $request->so_luong;
        $warehouse->ton_kho -= $request->so_luong;
        $warehouse->save();

        return redirect()->route('admin.protection.index')->with('msg', 'Cập nhật thông tin thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $protection = Protection::find($id);
        $protection->delete();

        $warehouse = Warehouse::find($protection->warehouse_id);     
        $warehouse->tong_xuat -= $protection->so_luong;
        $warehouse->ton_kho += $protection->so_luong;
        $warehouse->save();

        return redirect()->route('admin.protection.index')->with('msg', "Xóa thông tin thành công");
    }

    public function restore($id) {
        $protection = Protection::withTrashed()->find($id);
        $protection->restore();

        $warehouse = Warehouse::find($protection->warehouse_id);     
        $warehouse->tong_xuat += $protection->so_luong;
        $warehouse->ton_kho -= $protection->so_luong;
        $warehouse->save();

        return redirect()->route('admin.protection.index')->with('msg', "Khôi phục thông tin thành công");
    }

    public function forceDelete($id) {
        $protection = Protection::withTrashed()->find($id);
        $protection->forceDelete();
        return redirect()->route('admin.protection.index')->with('msg', "Xóa thông tin khỏi hệ thành công");
    }
}
