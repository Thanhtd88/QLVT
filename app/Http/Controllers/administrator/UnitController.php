<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UnitController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $units = Unit::all();
        if(Auth::user()->role == 1){
            $units = Unit::withTrashed()->get();
        }
        return view('administrator.pages.unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('administrator.pages.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // dd($request->all());
        $name = $request->don_vi;
        //Validate
        $request->validate([
            'don_vi' => 'required|min:3|max:255'
        ],
        [
            'don_vi.required' => 'Tên không được để trống',
            'don_vi.min' => 'Tên có độ dài tối thiểu :min ký tự',
            'don_vi.max' => 'Tên có độ dài tối đa :max ký tự'     
        ]);
        
        $check = Unit::create([
            'don_vi' => $name,
            'slug' => $request->slug
        ]);

        $massage = $check ? 'Thêm mới thành công' : 'Thêm mới thất bại';
        
        return redirect()->route('admin.unit.index')->with('msg', $massage);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug) {
        $unit = Unit::where('slug', $slug)->first();
        return view('administrator.pages.unit.detail')->with('unit', $unit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        
        $request->validate([
            'don_vi' => 'required|min:3|max:255',
            'slug' => 'required'
        ],
        [
            'don_vi.required' => 'Tên không được để trống',
            'don_vi.min' => 'Tên có độ dài tối thiểu :min ký tự',
            'don_vi.max' => 'Tên có độ dài tối đa :max ký tự',
            'slug.required' => 'Tên không được để trống',
        ]);
        Unit::find($id)->update([
            'don_vi' => $request->don_vi,
            'slug' => $request->slug
        ]);         
       
        return redirect()->route('admin.unit.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        Unit::find($id)->delete();
        return redirect()->route('admin.unit.index')->with('msg', 'Xóa thành công');
    }

    public function createSlug(Request $request) {
        return response()->json([
            'slug' => Str::slug($request->don_vi ?? '')
        ]);
    }    

    public function restore($id) {
        $unit = Unit::withTrashed()->find($id);
        $unit->restore();
        return redirect()->route('admin.unit.index')->with('msg', 'Khôi phục thành công');
    }

    public function forceDelete($id) {
        $unit = Unit::withTrashed()->find($id);
        $unit->forceDelete();
        return redirect()->route('admin.unit.index')->with('msg', 'Xóa khỏi hệ thành công');
    }
}
