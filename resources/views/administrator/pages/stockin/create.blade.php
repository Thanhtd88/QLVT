@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nhập kho - Thêm mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.stock-in.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin hàng nhập</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.stock-in.store') }}">
                            @csrf
                            <div class="card-body style="display: block;"">    
                                <div class="row">
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group date reservationdate" id="ngay_nhap_kho" data-target-input="nearest">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Ngày nhập kho</span>
                                                </div>
                                                <input name="ngay_nhap_kho" type="text" value="{{ old('ngay_nhap_kho') }}" class="form-control datetimepicker-input" data-target="#ngay_nhap_kho" @error('ngay_nhap_kho') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                                <div class="input-group-append" data-target="#ngay_nhap_kho" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3 box-vihicle">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Vật tư</span>
                                            </div>
                                            <select class="form-control select2" style="" id="" name="warehouse_id">
                                                <option selected="selected"></option>
                                                @foreach ($warehouses as $warehouse)
                                                    <option value={{ $warehouse->id }}>{{ $warehouse->vat_tu }}</option>
                                                @endforeach                                    
                                            </select>
                                            @error('warehouse_id')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Số lượng</span>
                                            </div>
                                            <input type="number" class="form-control" id="name" name='so_luong_nhap' value="{{ old('so_luong_nhap') }}">
                                            @error('so_luong_nhap')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Đơn giá</span>
                                            </div>
                                            <input type="number" class="form-control" id="name" name='don_gia_nhap' value="{{ old('don_gia_nhap') }}">
                                            @error('don_gia_nhap')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3 box-vihicle">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Nhà cung cấp vật tư</span>
                                            </div>
                                            <select class="form-control select2" style="" id="" name="supplier_id">
                                                <option selected="selected"></option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value={{ $supplier->id }}>{{ $supplier->ten_ncc }}</option>
                                                @endforeach                                    
                                            </select>
                                            @error('the_loai')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
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
        </div>
    </section>
</div>
@endsection

@section('title')
    Nhập kho
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(function () {
            $('.select2').select2()  

            $('.reservationdate').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        })
    </script>
@endsection
