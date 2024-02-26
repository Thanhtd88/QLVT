@extends('administrator.layout.master')

@section('content')
@if (session('msg'))
  <div class="position-fixed top-0 right-0 p-3" style="z-index: 9; right: 35%; top: 10;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="0">
        <div class="toast-body alert-light">
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
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Loại</span>
                                        <select class="form-select" name="loai" required>
                                            <option value="" selected>--Lựa chọn--</option>
                                            <option {{ old('loai') === 0 ? 'selected' : '' }} value="0">Sửa chữa - Bảo dưỡng</option>
                                            <option {{ old('loai') === 1 ? 'selected' : '' }} value="1">Bảo hiểm</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('loai')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Ngày thực hiện</span>
                                        <input class="form-control datepicker" type="text" name="ngay_thuc_hien" value="{{ old('ngay_thuc_hien') }}" autocomplete="off" required/>
                                    </div>
                                    <x-input-error :messages="$errors->get('ngay_thuc_hien')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số xe</span>
                                        <input type="search" class="form-control" list="list-vehicle" name="vehicle_id" value="{{ request()->get('vehicle_id') }}" required>
                                        <datalist id="list-vehicle">
                                            @foreach ($vehicles as $vehicle)
                                            <option>{{ $vehicle->so_xe }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>     
                                    <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" style="color: red"/>                               
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số km</span>
                                        <input type="number" class="form-control" name="odo" value="{{ old('odo') }}">
                                    </div>
                                    <x-input-error :messages="$errors->get('odo')" class="mt-2" style="color: red"/>             
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Vật tư thay thế</span>
                                        <input type="search" class="form-control" list="list-vat-tu" name="warehouse_id" value="{{ request()->get('warehouse_id') }}" required>
                                        <datalist id="list-vat-tu">
                                            @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                            @endforeach  
                                        </datalist>
                                    </div>     
                                    <x-input-error :messages="$errors->get('warehouse_id')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số lượng</span>
                                        <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}" required>
                                    </div>          
                                    <x-input-error :messages="$errors->get('so_luong')" class="mt-2" style="color: red"/>                           
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
                        <div class="card-footer btn-group-sm">
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
    $(function () {
        $('.toast').toast('show');

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });
    })        
</script>        
@endsection