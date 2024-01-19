<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\administrator\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        if(Auth::user()->role == 1){
            $projects = Project::withTrashed()->get();
        }
        return view('administrator.pages.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.pages.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->du_an;
        //Validate
        $request->validate([
            'du_an' => 'required|min:3|max:255'
        ],
        [
            'du_an.required' => 'Tên không được để trống',
            'du_an.min' => 'Tên có độ dài tối thiểu :min ký tự',
            'du_an.max' => 'Tên có độ dài tối đa :max ký tự'     
        ]);
        
        //Cách 3: Eloquent (tương tác với Model)
        $check = Project::create([
            'du_an' => $name,
            'slug' => $request->slug
        ]);

        $massage = $check ? 'Thêm mới thành công' : 'Thêm mới thất bại';
        //Session Flash
        return redirect()->route('admin.project.index')->with('msg', $massage);
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
        $project = Project::where('slug', $slug)->first();
        return view('administrator.pages.project.detail')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'du_an' => 'required|min:3|max:255'
        ],
        [
            'du_an.required' => 'Tên không được để trống',
            'du_an.min' => 'Tên có độ dài tối thiểu :min ký tự',
            'du_an.max' => 'Tên có độ dài tối đa :max ký tự'     
        ]);   

        Project::find($id)->update([
            'du_an' => $request->du_an,
            'slug' => $request->slug
        ]);         
       
        return redirect()->route('admin.project.index')->with('msg', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::find($id)->delete();
        return redirect()->route('admin.project.index')->with('msg', 'Xóa thành công');
    }

    public function createSlug(Request $request) {
        return response()->json([
            'slug' => Str::slug($request->du_an ?? '')
        ]);
    }    

    public function restore($id) {
        $project = Project::withTrashed()->find($id);
        $project->restore();
        return redirect()->route('admin.project.index')->with('msg', 'Khôi phục thành công');
    }

    public function forceDelete($id) {
        $project = Project::withTrashed()->find($id);
        $project->forceDelete();
        return redirect()->route('admin.project.index')->with('msg', 'Xóa khỏi hệ thành công');
    }
}
