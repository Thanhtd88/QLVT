@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vật tư - Tạo mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.warehouse.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin vật tư</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.warehouse.store') }}">
                            @csrf
                            <div class="card-body style="display: block;"">    
                                <div class="row">
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Thể loại</span>
                                            </div>
                                            <select class="custom-select" name="the_loai">
                                                <option value="">--Lựa chọn--</option>
                                                <option {{ old('trangthai') == '0' ? 'selected' : '' }} value="0">Phụ tùng</option>
                                                <option {{ old('trangthai') == '1' ? 'selected' : '' }} value="1">Trang bị bảo hộ</option>
                                            </select>
                                            @error('the_loai')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Mã vật tư</span>
                                            </div>
                                            <input type="text" class="form-control" id="name" name='ma_vat_tu' value="{{ old('ma_vat_tu') }}">
                                            @error('ma_vat_tu')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tên vật tư</span>
                                            </div>
                                            <input type="text" class="form-control" id="name" name='vat_tu' value="{{ old('vat_tu') }}">
                                            @error('vat_tu')
                                                <span style="color: red; font-size: 14px">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Đơn vị tính</span>
                                            </div>
                                            <input type="text" class="form-control" id="name" name='don_vi_tinh' value="{{ old('don_vi_tinh') }}">
                                            @error('don_vi_tinh')
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
    Kho vật tư
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(function () {
            $('.select2').select2()  
        })
    </script>
@endsection
