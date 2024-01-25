@extends('administrator.layout.master')

@section('content')
@if (session('msg'))
  <div class="position-fixed top-0 right-0 p-3" style="z-index: 9; right: 35%; top: 10;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="0">
        <div class="toast-body alert-success">
            {{ session('msg') }}
        </div>
    </div>
  </div>
@endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Phương tiện sửa chữa    </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.maintenance.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin bảo dưỡng - sửa chữa</h3>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('admin.maintenance.store') }}">
                        @csrf
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Hành động</span>
                                        </div>
                                        <select class="custom-select" name="loai">
                                            <option value="">--Lựa chọn--</option>
                                            <option {{ old('loai') == 0 ? 'selected' : '' }} value="0">Sửa chữa - Bảo dưỡng</option>
                                            <option {{ old('loai') == 1 ? 'selected' : '' }} value="1">Bảo hiểm</option>
                                        </select>
                                        @error('loai') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_thuc_hien" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ngày thực hiện</span>
                                            </div>
                                            <input name="ngay_thuc_hien" type="text" value="{{ old('ngay_thuc_hien') }}" class="form-control datetimepicker-input" data-target="#ngay_thuc_hien" />
                                            <div class="input-group-append" data-target="#ngay_thuc_hien" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            @error('ngay_thuc_hien') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 box-vihicle">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số xe</span>
                                        </div>
                                        <select class="form-control select2" name="vihicle_id">
                                            <option value=""></option>
                                            @foreach ($vihicles as $vihicle)
                                                <option value={{ $vihicle->id }}>{{ $vihicle->so_xe }}</option>
                                            @endforeach                                    
                                        </select>
                                    </div>                                    
                                </div>@error('vihicle_id') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số km</span>
                                        </div>
                                        <input type="number" class="form-control" name="odo" value="{{ old('odo') }}">
                                    </div>
                                    @error('odo') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 box-vihicle">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Vật tư thay thế</span>
                                        </div>
                                        <select class="form-control select2" name="warehouse_id">
                                            <option selected="selected"></option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value={{ $warehouse->id }}>{{ $warehouse->vat_tu }}</option>
                                            @endforeach                                    
                                        </select>
                                        @error('warehouse_id') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số lượng</span>
                                        </div>
                                        <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}">
                                        @error('so_luong') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>                                    
                                </div>
                                {{-- <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Seri (vỏ xe/bình)</span>
                                        </div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div> --}}
                            </div>                            
                        </div>
                        <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu & tiếp tục</button>                            
                            <a href="{{ route('admin.maintenance.index') }}" class="btn btn-danger float-right"><i class="fas fa-times"></i> Thoát</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </section> 
</div>
@endsection

@section('title')
    Bảo dưỡng - sửa chữa
@endsection

@section('js-custom')
<script type="text/javascript">
    $(document).ready(function(){
        $('.toast').toast('show');
    });
    $(function () {
        $('.select2').select2()  
    })
    $('.reservationdate').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>        
@endsection