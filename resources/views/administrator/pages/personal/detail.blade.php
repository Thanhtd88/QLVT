@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nhân sự - Cập nhật</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.personal.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin cá nhân</h3>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('admin.personal.update', ['personal' => $personal->id]) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="box1 col-md-2">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-stream"></i></span>
                                        </div>
                                        <input value="{{ old('ma_nv') ?? $personal->ma_nv }}" type="number" class="form-control" placeholder="Mã nhân viên" name="ma_nv" readonly>
                                    </div>
                                    <x-input-error :messages="$errors->get('ma_nv')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input value="{{ old('ho_ten') ?? $personal->ho_ten }}" type="text" class="form-control" placeholder="Họ tên" name="ho_ten">
                                    </div>
                                    <x-input-error :messages="$errors->get('ho_ten')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngaysinh" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngaysinh" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-birthday-cake"></i></div>
                                            </div>
                                            <input name="ngay_sinh" type="text" value="{{ old('ngay_sinh')  ?? date("d-m-Y", strtotime($personal->ngay_sinh)) }}" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_sinh')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input value="{{ old('sdt') ?? $personal->sdt }}" type="text" class="form-control" placeholder="Số điện thoại" name="sdt">
                                    </div>
                                    <x-input-error :messages="$errors->get('sdt')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-12">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input value="{{ old('dia_chi') ?? $personal->dia_chi }}" type="text" class="form-control" placeholder="Địa chỉ" name="dia_chi">
                                    </div>
                                    <x-input-error :messages="$errors->get('dia_chi')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                        </div>
                                        <input value="{{ old('cccd') ?? $personal->cccd }}" type="text" class="form-control" placeholder="Căn cước công dân" name="cccd">
                                    </div>
                                    <x-input-error :messages="$errors->get('cccd')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngaycap_cccd" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngaycap_cccd" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <input name="ngay_cap_cccd" type="text" value="{{ old('ngay_cap_cccd') ?? date("d-m-Y", strtotime($personal->ngay_cap_cccd)) }}" class="form-control datetimepicker-input" data-target="#reservationdate-cccd"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_cap_cccd')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input value="{{ old('noi_cap_cccd') ?? $personal->noi_cap_cccd }}" type="text" class="form-control" placeholder="Nơi cấp CCCD" name="noi_cap_cccd">
                                    </div>
                                    <x-input-error :messages="$errors->get('noi_cap_cccd')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>  
                                        <input value="{{ old('gplx') ?? $personal->gplx }}" type="text" class="form-control" placeholder="Số giấy phép lái xe" name="gplx">
                                    </div>
                                    <x-input-error :messages="$errors->get('gplx')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-2">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        </div>
                                        <input value="{{ old('hang_gplx') ?? $personal->hang_gplx }}" type="text" class="form-control" placeholder="Hạng bằng lái" name="hang_gplx">
                                    </div>
                                    <x-input-error :messages="$errors->get('hang_gplx')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_cap_gplx" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_cap_gplx" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <input name="ngay_cap_gplx" type="text" value="{{ old('ngay_cap_gplx') ?? !is_null($personal->ngay_cap_gplx) ? date("d-m-Y", strtotime($personal->ngay_cap_gplx)) : '' }}" class="form-control datetimepicker-input" data-target="#reservationdate-cccd" placeholder="Ngày cấp GPLX"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_cap_gplx')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input value="{{ old('noi_cap_gplx') ?? $personal->noi_cap_gplx }}" type="text" class="form-control" placeholder="Nơi cấp GPLX" name="noi_cap_gplx">
                                    </div>
                                    @error('noi_cap_gplx') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>
                                <div class="box1 col-md-12">    
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control" name="image_url">
                                    </div>
                                    <x-input-error :messages="$errors->get('image_url')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">    
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-building"></i></span>
                                        </div>
                                        <select class="custom-select" name="department_id">
                                            <option value="">--- Vui lòng chọn phòng ban ---</option>
                                            @foreach ($departments as $department)
                                                <option {{ old('department_id') ?? $personal->department_id == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->phong_ban }}</option>  
                                            @endforeach                                                
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('department_id')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-circle nav-icon"></i></span>
                                        </div>
                                        <select class="custom-select" name="unit_id">
                                            <option value="">--- Vui lòng chọn đơn vị ---</option>
                                            @foreach ($units as $unit)
                                                <option {{ old('unit_id') ?? $personal->unit_id == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->don_vi }}</option>  
                                            @endforeach  
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('unit_id')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-project-diagram"></i></span>
                                        </div>
                                        <select class="custom-select" name="project_id">
                                            <option value="">--- Vui lòng chọn dự án ---</option>
                                            @foreach ($projects as $project)
                                                <option {{ old('project_id') ?? $personal->project_id == $project->id ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->du_an }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('project_id')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('ngay_vao')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_vao" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_vao" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <input name="ngay_vao" type="text" value="{{ old('ngay_vao')  ?? date("d-m-Y", strtotime($personal->ngay_vao)) }}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Ngày vào làm"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_vao')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_nghi" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_nghi" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <input name="ngay_nghi" type="text" value="{{ old('ngay_nghi')  ?? $personal->ngay_nghi ? date("d-m-Y", strtotime($personal->ngay_nghi)) : null }}" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Ngày nghỉ"/>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('ngay_nghi')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4 personal-check">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="customSwitch1" name="bhxh" {{ old('status') ?? $personal->bhxh === 'on' ? 'checked' : '' }}>
                                          <label class="custom-control-label" for="customSwitch1">Bảo hiểm xã hội</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
      
                        <div class="card-footer btn-group-sm">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('admin.personal.index') }}" class="btn btn-danger"><i class="fas fa-times"></i> Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </section> 
</div>
@endsection

@section('title')
    Nhân sự
@endsection

@section('js-custom')
<script>
    $(function () {
        $('.reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    })
</script>
@endsection