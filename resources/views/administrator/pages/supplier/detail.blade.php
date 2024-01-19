@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nhà cung cấp - Cập nhật</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.supplier.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Khai báo nhà cung cấp mới</h3>
                            <div class="card-tools"></div>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('admin.supplier.update', ['supplier' => $supplier->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="box1 col-md-12">
                                    @error('ma_ncc')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>                                            
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label>Mã nhà cung cấp</label>
                                        <input value="{{ old('ma_ncc') ?? $supplier->ma_ncc }}" type="text" class="form-control" name="ma_ncc" autofocus>
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    @error('ten_ncc')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label>Tên nhà cung cấp</label>
                                        <input value="{{ old('ten_ncc') ?? $supplier->ten_ncc }}" type="text" class="form-control" name="ten_ncc">
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    @error('dia_chi')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label>Địa chỉ</label>
                                        <input  value="{{ old('dia_chi') ?? $supplier->dia_chi }}" type="text" class="form-control" name="dia_chi">
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    @error('sdt')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group mb-3">
                                        <label>Điện thoại</label>
                                        <input  value="{{ old('sdt') ?? $supplier->sdt }}" type="text" class="form-control" name="sdt">
                                    </div>
                                </div>
                            </div>        
                        </div>    
                        <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('admin.supplier.index') }}" class="btn btn-danger float-right"><i class="fas fa-times"></i> Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </section> 
</div>
@endsection

@section('title')
    Nhà cung cấp
@endsection