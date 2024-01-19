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
                                    @error('ma_nv')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>                                            
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-stream"></i></span>
                                        </div>
                                        <input value="{{ old('ma_nv') }}" type="number" class="form-control" placeholder="Mã nhân viên" name="ma_nv" autofocus>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('ho_ten')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input value="{{ old('ho_ten') }}" type="text" class="form-control" placeholder="Họ tên" name="ho_ten">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    @error('ngay_sinh')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_sinh" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_sinh" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fas fa-birthday-cake"></i></div>
                                            </div>
                                            <input name="ngay_sinh" type="text" value="{{ old('ngay_sinh') }}" class="form-control datetimepicker-input" data-target="#ngay_sinh" placeholder="Ngày sinh"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    @error('sdt')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                        </div>
                                        <input  value="{{ old('sdt') }}" type="text" class="form-control" placeholder="Số điện thoại" name="sdt">
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    @error('dia_chi')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input value="{{ old('dia_chi') }}" type="text" class="form-control" placeholder="Địa chỉ" name="dia_chi">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('cccd')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-id-card"></i></span>
                                        </div>
                                        <input value="{{ old('cccd') }}" type="text" class="form-control" placeholder="Căn cước công dân" name="cccd">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('ngay_cap_cccd')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_cap_cccd" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_cap_cccd" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <input name="ngay_cap_cccd" type="text" value="{{ old('ngay_cap_cccd') }}" class="form-control datetimepicker-input" data-target="#ngay_cap_cccd" placeholder="Ngày cấp CCCD"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('noi_cap_cccd')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input value="{{ old('noi_cap_cccd') }}" type="text" class="form-control" placeholder="Nơi cấp CCCD" name="noi_cap_cccd">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('gplx')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>  
                                        <input value="{{ old('gplx') }}" type="text" class="form-control" placeholder="Số giấy phép lái xe" name="gplx">
                                    </div>
                                </div>
                                <div class="box1 col-md-2">
                                    @error('hang_gplx')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        </div>
                                        <input value="{{ old('hang_gplx') }}" type="text" class="form-control" placeholder="Hạng GPLX" name="hang_gplx">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_cap_gplx" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_cap_gplx" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            <input name="ngay_cap_gplx" type="text" value="{{ old('ngay_cap_gplx') }}" class="form-control datetimepicker-input" data-target="#ngay_cap_gplx" placeholder="Ngày cấp GPLX"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    @error('noi_cap_gplx')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                        <input value="{{ old('noi_cap_gplx') }}" type="text" class="form-control" placeholder="Nơi cấp GPLX" name="noi_cap_gplx">
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-image"></i></span>
                                        </div>
                                        <input type="file" class="form-control" name="image_url">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    @error('department_id')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
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
                                </div>
                                <div class="box1 col-md-4">
                                    @error('unit_id')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
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
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
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
                                </div>
                                <div class="box1 col-md-4">
                                    @error('ngay_vao')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_vao" data-target-input="nearest">
                                            <div class="input-group-prepend" data-target="#ngay_vao" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                                            </div>
                                            <input name="ngay_vao" type="text" value="{{ old('ngay_vao') }}" class="form-control datetimepicker-input" data-target="#ngay_vao" placeholder="Ngày vào làm"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4 personal-check">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="customSwitch1" name="bhxh">
                                          <label class="custom-control-label" for="customSwitch1">Bảo hiểm xã hội</label>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>    
                        <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
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