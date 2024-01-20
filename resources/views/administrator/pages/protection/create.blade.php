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
                    <h1>Trang bị bảo hộ - Cấp mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.protection.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin cấp trang bị</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.protection.store') }}">         
                            @csrf
                            <div class="card-body"> 
                                <div class="input-group mb-3">
                                    <label for="">Ngày cấp</label>
                                    <div class="input-group date reservationdate" id="ngay_ban_giao" data-target-input="nearest">                                        
                                        <input name="ngay_ban_giao" type="text" class="form-control datetimepicker-input" data-target="#ngay_ban_giao" @error('ngay_ban_giao') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                        <div class="input-group-append" data-target="#ngay_ban_giao" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="personal_id">Người nhận</label>
                                    <select class="form-control select2" style="" id="personal_id" name="personal_id">
                                        <option selected="selected"></option>
                                        @foreach ($personals as $personal)
                                            <option value={{ $personal->id }}>{{ $personal->ho_ten }}</option>
                                        @endforeach                                    
                                    </select>
                                    @error('personal_id')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                </div>  
                                <div class="form-group">
                                    <label for="warehouse_id">Trang bị</label>
                                    <select class="form-control select2" style="" id="warehouse_id" name="warehouse_id">
                                        <option selected="selected"></option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value={{ $warehouse->id }}>{{ $warehouse->vat_tu }}</option>
                                        @endforeach                                    
                                    </select>
                                    @error('warehouse_id')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="so_luong">Số lượng</label>
                                    <input type="number" class="form-control" id="so_luong" name="so_luong">
                                </div>                    
                            <!-- /.card-body --> 
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('title')
    Trang bị bảo hộ
@endsection

@section('js-custom')
<script type="text/javascript">
    $(document).ready(function(){
        $('.toast').toast('show');
    });
    $(function () {
        $('.select2').select2();
        $('.reservationdate').datetimepicker({
            format: 'DD/MM/YYYY hh:mm:ss'
        });  
    })
</script>
@endsection