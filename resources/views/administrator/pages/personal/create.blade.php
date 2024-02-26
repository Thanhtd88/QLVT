@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nhân sự - Thêm mới</h1>
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
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Khai báo nhân viên mới</h3>
                            <div class="card-tools"></div>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('admin.personal.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="box1 col-md-2">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-stream"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('ma_nv') }}" type="number" class="form-control" placeholder="Mã nhân viên" name="ma_nv" autofocus/>
                                    </div>
                                    <x-input-error :messages="$errors->get('ma_nv')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('ho_ten') }}" type="text" class="form-control" placeholder="Họ tên" name="ho_ten"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('ho_ten')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_sinh" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_sinh" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-birthday-cake"></i></div>
                                            </div>
                                            <x-text-input name="ngay_sinh" type="text" value="{{ old('ngay_sinh') }}" class="form-control datetimepicker-input" data-target="#ngay_sinh" placeholder="Ngày sinh"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_sinh')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <x-text-input  value="{{ old('sdt') }}" type="text" class="form-control" placeholder="Số điện thoại" name="sdt"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('sdt')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-12">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('dia_chi') }}" type="text" class="form-control" placeholder="Địa chỉ" name="dia_chi"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('dia_chi')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('cccd') }}" type="text" class="form-control" placeholder="Căn cước công dân" name="cccd"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('cccd')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_cap_cccd" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_cap_cccd" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <x-text-input name="ngay_cap_cccd" type="text" value="{{ old('ngay_cap_cccd') }}" class="form-control datetimepicker-input" data-target="#ngay_cap_cccd" placeholder="Ngày cấp CCCD"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_cap_cccd')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('noi_cap_cccd') }}" type="text" class="form-control" placeholder="Nơi cấp CCCD" name="noi_cap_cccd"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('noi_cap_cccd')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>  
                                        <x-text-input value="{{ old('gplx') }}" type="text" class="form-control" placeholder="Số giấy phép lái xe" name="gplx"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('gplx')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-2">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('hang_gplx') }}" type="text" class="form-control" placeholder="Hạng GPLX" name="hang_gplx"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('hang_gplx')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_cap_gplx" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_cap_gplx" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <x-text-input name="ngay_cap_gplx" type="text" value="{{ old('ngay_cap_gplx') }}" class="form-control datetimepicker-input" data-target="#ngay_cap_gplx" placeholder="Ngày cấp GPLX"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_cap_gplx')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <x-text-input value="{{ old('noi_cap_gplx') }}" type="text" class="form-control" placeholder="Nơi cấp GPLX" name="noi_cap_gplx"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('noi_cap_gplx')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-12">
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-image"></i></span>
                                        </div>
                                        <x-text-input type="file" class="form-control" name="image_url" accept="image/jpeg, image/png"/>
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
                                                <option {{ old('department_id') == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->phong_ban }}</option>  
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
                                                <option {{ old('unit_id') == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->don_vi }}</option>  
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
                                                <option {{ old('project_id') == $project->id ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->du_an }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('project_id')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate input-group-sm" id="ngay_vao" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_vao" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                            </div>
                                            <x-text-input name="ngay_vao" type="text" value="{{ old('ngay_vao') }}" class="form-control datetimepicker-input" data-target="#ngay_vao" placeholder="Ngày vào làm"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_vao')" class="mt-2" style="color: red"/>
                                    </div>
                                </div>
                                <div class="box1 col-md-4 personal-check">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="bhxh" name="bhxh">
                                        <label class="form-check-label" for="bhxh">Bảo hiểm xã hội</label>
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