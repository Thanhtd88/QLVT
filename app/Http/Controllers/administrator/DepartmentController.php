<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        if(Auth::user()->role == 1){
            $departments = Department::withTrashed()->get();
        }
        return view('administrator.pages.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.pages.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->phong_ban;
        //Validate
        $request->validate([
            'phong_ban' => 'required|min:3|max:255'
        ],
        [
            'phong_ban.required' => 'Tên không được để trống',
            'phong_ban.min' => 'Tên có độ dài tối thiểu :min ký tự',
            'phong_ban.max' => 'Tên có độ dài tối đa :max ký tự'     
        ]);
        
        //Cách 3: Eloquent (tương tác với Model)
        $check = Department::create([
            'phong_ban' => $name,
            'slug' => $request->slug
        ]);

        $massage = $check ? 'Thêm mới thành công' : 'Thêm mới thất bại';
        //Session Flash
        return redirect()->route('admin.department.index')->with('msg', $massage);
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
    public function edit(string $slug)
    {
        $department = Department::where('slug', $slug)->first();
        return view('administrator.pages.department.detail')->with('department', $department);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'phong_ban' => 'required|min:3|max:255'
        ],
        [
            'phong_ban.required' => 'Tên không được để trống',
            'phong_ban.min' => 'Tên có độ dài tối thiểu :min ký tự',
            'phong_ban.max' => 'Tên có độ dài tối đa :max ký tự'     
        ]); 
        Department::find($id)->update([
            'phong_ban' => $request->phong_ban,
            'slug' => $request->slug
        ]);
        return redirect()->route('admin.department.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::find($id)->delete();
        return redirect()->route('admin.department.index')->with('msg', 'Xóa thành công');
    }

    public function createSlug(Request $request) {
        return response()->json([
            'slug' => Str::slug($request->phong_ban ?? '')
        ]);
    }    

    public function restore($id) {
        $department = Department::withTrashed()->find($id);
        $department->restore();
        return redirect()->route('admin.department.index')->with('msg', 'Khôi phục thành công');
    }

    public function forceDelete($id) {
        $department = Department::withTrashed()->find($id);
        $department->forceDelete();
        return redirect()->route('admin.department.index')->with('msg', 'Xóa khỏi hệ thống thành công');
    }
}
