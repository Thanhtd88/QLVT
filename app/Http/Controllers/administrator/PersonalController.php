<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\Personal\StoreRequest;
use App\Http\Requests\Administrator\Personal\UpdateRequest;
use App\Models\administrator\Department;
use App\Models\administrator\Personal;
use App\Models\administrator\Project;
use App\Models\administrator\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $keyword = $request->keyword ?? '';
        // $keyword = '%'.$keyword.'%';
        // $sort = $request->sort ?? 'Mới nhất';
        // $direction = $sort === 'Mới nhất' ? "DESC" : "ASC";
        
        
        $personals = Personal::with('project')->get();
        if(Auth::user()->role == 1){
            $personals = Personal::with('project')->withTrashed()->get();
        }
        
        // ->where('hoten', 'like', $keyword)
        // ->orWhere('manv', 'like', $keyword)
        // ->orderBy('created_at', $direction)
        // ->paginate(10);
        return view('administrator.pages.personal.index')->with('personals', $personals); //compact('personals') dùng cho paginate
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        $projects = Project::all();
        $departments = Department::all();
        // $vihicles = Vihicle::all();
        return view('administrator.pages.personal.create')
        ->with('units', $units)
        ->with('projects', $projects)
        ->with('departments', $departments);
        // ->with('vihicles', $vihicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $ngay_sinh = Carbon::createFromFormat('d/m/Y', $request->ngay_sinh)->format('Y-m-d');
        $ngay_cccd = Carbon::createFromFormat('d/m/Y', $request->ngay_cap_cccd)->format('Y-m-d');        
        $ngay_vao = Carbon::createFromFormat('d/m/Y', $request->ngay_vao)->format('Y-m-d');
        
        $fileName = $this->storeImage($request);

        if(!is_null($request->ngay_cap_gplx)){
            $ngay_gplx = Carbon::createFromFormat('d/m/Y', $request->ngay_cap_gplx)->format('Y-m-d');
            $nam = 5;
            if($request->hang_gplx === 'B2'){ $nam = 10; };
            $hieu_luc_gplx = Carbon::parse($ngay_gplx);
            $hieu_luc_gplx->toDateTimeString();
            $hieu_luc_gplx->addYears($nam);
        }
        $arrayData = [
            'ma_nv' => $request->ma_nv,
            'ho_ten' => $request->ho_ten,
            'ngay_sinh' => $ngay_sinh,
            'sdt' => $request->sdt,
            'dia_chi' => $request->dia_chi,
            'cccd' => $request->cccd,
            'ngay_cap_cccd' => $ngay_cccd,
            'noi_cap_cccd' => $request->noi_cap_cccd,
            'gplx' => $request->gplx,
            'hang_gplx' => $request->hang_gplx,
            'ngay_cap_gplx' => $ngay_gplx ?? null,
            'noi_cap_gplx' => $request->noi_cap_gplx,
            'hieu_luc_gplx' => $hieu_luc_gplx ?? null,
            'department_id' => $request->department_id,
            'unit_id' => $request->unit_id,
            'project_id' => $request->project_id,
            'ngay_vao' => $ngay_vao,
            'trang_thai' => 0,
            'bhxh' => $request->bhxh
        ];
        $arrayData['image_url'] = $fileName;
        
        Personal::create($arrayData);
        
        return redirect()->route('admin.personal.index')->with('msg', "Thêm nhân viên $request->ho_ten thành công");
    }

    private function storeImage(Request $request) {
        $fileName = null;
        if($request->hasFile('image_url')){
            $originName = $request->file('image_url')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '_' . $extension;
            $request->file('image_url')->move(public_path('image'), $fileName);
        }
        return $fileName;
    }

    public function show()
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $ma_nv)
    {
        $units = Unit::all();
        $projects = Project::all();
        $departments = Department::all();
        $personal = Personal::where('ma_nv', $ma_nv)->first();
        return view('administrator.pages.personal.detail')
        ->with('units', $units)
        ->with('projects', $projects)
        ->with('departments', $departments)
        ->with('personal', $personal);    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $ngay_sinh = Carbon::createFromFormat('d/m/Y', $request->ngay_sinh)->format('Y-m-d');
        $ngay_cccd = Carbon::createFromFormat('d/m/Y', $request->ngay_cap_cccd)->format('Y-m-d');        
        $ngay_vao = Carbon::createFromFormat('d/m/Y', $request->ngay_vao)->format('Y-m-d');
        
        if(!is_null($request->ngay_nghi)){
            $ngay_nghi = Carbon::createFromFormat('d/m/Y', $request->ngay_nghi)->format('Y-m-d');
        }
        
        if(!is_null($request->ngay_cap_gplx)){
            $ngay_gplx = Carbon::createFromFormat('d/m/Y', $request->ngay_cap_gplx)->format('Y-m-d');
            $nam = 5;
            if($request->hang_gplx === 'B2'){ $nam = 10; };
            $hieu_luc_gplx = Carbon::parse($ngay_gplx);
            $hieu_luc_gplx->toDateTimeString();
            $hieu_luc_gplx->addYears($nam);
        }

        $personal = Personal::find($id);
        $oldImage = $personal->image_url;
        $arrayData = [
            'ma_nv' => $request->ma_nv,
            'ho_ten' => $request->ho_ten,
            'sdt' => $request->sdt,
            'ngay_sinh' => $ngay_sinh,
            'dia_chi' => $request->dia_chi,
            'cccd' => $request->cccd,
            'ngay_cap_cccd' => $ngay_cccd,
            'noi_cap_cccd' => $request->noi_cap_cccd,
            'gplx' => $request->gplx,
            'hang_gplx' => $request->hang_gplx,
            'ngay_cap_gplx' => $ngay_gplx ?? null,
            'noi_cap_gplx' => $request->noi_cap_gplx,
            'hieu_luc_gplx' => $hieu_luc_gplx ?? null,
            'department_id' => $request->department_id,
            'unit_id' => $request->unit_id,
            'project_id' => $request->project_id,
            'ngay_vao' => $ngay_vao,
            'ngay_nghi' => Carbon::createFromFormat('d/m/Y', $request->ngay_nghi)->format('Y-m-d') ?? null,
            'trang_thai' => !is_null($request->ngay_nghi) ? 1 : 0,
            'bhxh' => $request->bhxh
        ];
        $fileName = $this->storeImage($request);
        
        if(!is_null($fileName)){
            $arrayData['image_url'] = $fileName;
            if(!is_null($oldImage)){
                unlink(public_path('image').'/'.$oldImage);
            }            
        }
        $personal->update($arrayData);
        return redirect()->route('admin.personal.index')->with('msg', "Cập nhật thông tin $request->ho_ten thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personal = Personal::find($id);
        $personal->delete();
        return redirect()->route('admin.personal.index')->with('msg', "Xóa nhân viên $personal->ho_ten thành công");
    }

    public function restore($id) {
        $personal = Personal::withTrashed()->find($id);
        $personal->restore();
        return redirect()->route('admin.personal.index')->with('msg', "Khôi phục thông tin $personal->ho_ten thành công");
    }

    public function forceDelete($id) {
        $personal = Personal::withTrashed()->find($id);
        $personal->forceDelete();
        return redirect()->route('admin.personal.index')->with('msg', "Xóa nhân viên $personal->ho_ten khỏi hệ thành công");
    }

}
