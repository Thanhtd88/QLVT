@extends('administrator.layout.master')

@section('content')
@if (session('msg'))
    @include('administrator.pages.notification')
@endif
<div class="content-wrapper text-md">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bàn giao xe</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.transfer.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <form role="form" method="POST" action="{{ route('admin.transfer.store') }}">
    @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" method="POST" action="{{ route('admin.transfer.store') }}">
                        @csrf
                        <div class="card card-default">                        
                            <div class="card-header">
                                <h3 class="card-title">Thông tin bàn giao</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">    
                                <div class="row">             
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ngày bàn giao</span>
                                            <input class="form-control datepicker" type="text" name="ngay_ban_giao" value="{{ old('ngay_ban_giao') ?? $time }}" autocomplete="off" required/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_ban_giao')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Loại biên bản</span>
                                            <select class="form-select" id="loai_bien_ban" name="loai_bien_ban" required>
                                            <option value="">--Lựa chọn--</option>
                                            <option {{ old('loai_bien_ban') == '0' ? 'selected' : '' }} value="0">Bàn giao</option>
                                            <option {{ old('loai_bien_ban') == '1' ? 'selected' : '' }} value="1">Thu hồi</option>
                                          </select>
                                        </div>
                                    </div>     
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Số biên bản</span>
                                            <input type="text" class="form-control" name="so_bien_ban" value="BMT/ADX-BGX-{{ $maxId + 1 }}" required>
                                        </div>
                                    </div>                 
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Người bàn giao</span>
                                            <input type="search" class="form-control" list="list-d_personal" name="d_personal_id" value="{{ old('d_personal_id') }}" required autofocus>
                                            <datalist id="list-d_personal">
                                                @foreach ($personals as $personal)
                                                <option>{{ $personal->ma_nv .'-'. $personal->ho_ten }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>     
                                        <x-input-error :messages="$errors->get('d_personal_id')" class="mt-2" style="color: red"/>                               
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Người nhận bàn giao</span>
                                            <input type="search" class="form-control" list="list-r_personal" name="r_personal_id" value="{{ old('r_personal_id') }}" required>
                                            <datalist id="list-r_personal">
                                                @foreach ($personals as $personal)
                                                <option>{{ $personal->ma_nv .'-'. $personal->ho_ten }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>     
                                        <x-input-error :messages="$errors->get('r_personal_id')" class="mt-2" style="color: red"/>                               
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Số xe bàn giao</span>
                                            <input type="search" class="form-control" list="list-vehicle" name="vehicle_id" value="{{ old('vehicle_id') }}" required>
                                            <datalist id="list-vehicle">
                                                @foreach ($vehicles as $vehicle)
                                                <option>{{ $vehicle->so_xe }}</option>
                                                @endforeach
                                            </datalist>
                                        </div>     
                                        <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" style="color: red"/>                               
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">     
                            <div class="card-header">
                                <h3 class="card-title">Trang bị theo xe (Bổ sung)</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">    
                                <div class="row">
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <select class="form-select" id="trang_bi_theo_xe1" name="trang_bi_theo_xe1">
                                                <option value="">--Lựa chọn--</option>
                                                <option {{ old('trang_bi_theo_xe1') == '0' ? 'selected' : '' }} value="0">Bạt lót sàn</option>
                                                <option {{ old('trang_bi_theo_xe1') == '1' ? 'selected' : '' }} value="1">Pallet</option>
                                                <option {{ old('trang_bi_theo_xe1') == '1' ? 'selected' : '' }} value="2">Thiết bị ghi nhiệt độ Logtag</option>
                                                <option {{ old('trang_bi_theo_xe1') == '1' ? 'selected' : '' }} value="3">Bộ dụng cụ thay bánh xe</option>
                                            </select>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <select class="form-select" id="trang_bi_theo_xe2" name="trang_bi_theo_xe2">
                                                <option value="">--Lựa chọn--</option>
                                                <option {{ old('trang_bi_theo_xe2') == '0' ? 'selected' : '' }} value="0">Bạt lót sàn</option>
                                                <option {{ old('trang_bi_theo_xe2') == '1' ? 'selected' : '' }} value="1">Pallet</option>
                                                <option {{ old('trang_bi_theo_xe2') == '1' ? 'selected' : '' }} value="2">Thiết bị ghi nhiệt độ Logtag</option>
                                                <option {{ old('trang_bi_theo_xe2') == '1' ? 'selected' : '' }} value="3">Bộ dụng cụ thay bánh xe</option>
                                            </select>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <select class="form-select" id="trang_bi_theo_xe3" name="trang_bi_theo_xe3">
                                                <option value="">--Lựa chọn--</option>
                                                <option {{ old('trang_bi_theo_xe3') == '0' ? 'selected' : '' }} value="0">Bạt lót sàn</option>
                                                <option {{ old('trang_bi_theo_xe3') == '1' ? 'selected' : '' }} value="1">Pallet</option>
                                                <option {{ old('trang_bi_theo_xe3') == '1' ? 'selected' : '' }} value="2">Thiết bị ghi nhiệt độ Logtag</option>
                                                <option {{ old('trang_bi_theo_xe3') == '1' ? 'selected' : '' }} value="3">Bộ dụng cụ thay bánh xe</option>
                                            </select>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('so_luong')" class="mt-2" style="color: red"/>
                                    </div>                                    
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <select class="form-select" id="trang_bi_theo_xe4" name="trang_bi_theo_xe4">
                                                <option value="">--Lựa chọn--</option>
                                                <option {{ old('trang_bi_theo_xe4') == '0' ? 'selected' : '' }} value="0">Bạt lót sàn</option>
                                                <option {{ old('trang_bi_theo_xe4') == '1' ? 'selected' : '' }} value="1">Pallet</option>
                                                <option {{ old('trang_bi_theo_xe4') == '1' ? 'selected' : '' }} value="2">Thiết bị ghi nhiệt độ Logtag</option>
                                                <option {{ old('trang_bi_theo_xe4') == '1' ? 'selected' : '' }} value="3">Bộ dụng cụ thay bánh xe</option>
                                            </select>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong" value="{{ old('so_luong') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">     
                            <div class="card-header">
                                <h3 class="card-title">Trang bị bảo hộ lao động</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">    
                                <div class="row">
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-1" name="warehouse_id_1" value="{{ old('warehouse_id') }}">
                                            <datalist id="list-trang-bi-1">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_1" value="{{ old('so_luong_1') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-2" name="warehouse_id_2" value="{{ old('warehouse_id_2') }}">
                                            <datalist id="list-trang-bi-2">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_2" value="{{ old('so_luong_2') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-3" name="warehouse_id_3" value="{{ old('warehouse_id_3') }}">
                                            <datalist id="list-trang-bi-3">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_3" value="{{ old('so_luong_3') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-4" name="warehouse_id_4" value="{{ old('warehouse_id_4') }}">
                                            <datalist id="list-trang-bi-4">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_4" value="{{ old('so_luong_4') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-5" name="warehouse_id_5" value="{{ old('warehouse_id_5') }}">
                                            <datalist id="list-trang-bi-5">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_5" value="{{ old('so_luong_5') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-6" name="warehouse_id_6" value="{{ old('warehouse_id_6') }}">
                                            <datalist id="list-trang-bi-6">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_6" value="{{ old('so_luong_6') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-7" name="warehouse_id_7" value="{{ old('warehouse_id_7') }}">
                                            <datalist id="list-trang-bi-7">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_7" value="{{ old('so_luong_7') }}">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tên trang bị</span>
                                            <input type="search" class="form-control" list="list-trang-bi-8" name="warehouse_id_8" value="{{ old('warehouse_id_8') }}">
                                            <datalist id="list-trang-bi-8">
                                                @foreach ($warehouses as $warehouse)
                                                <option>{{ $warehouse->vat_tu }}</option>
                                                @endforeach
                                            </datalist>
                                            <span class="input-group-text">Số lượng</span>
                                            <input type="number" class="form-control" name="so_luong_8" value="{{ old('so_luong_8') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-default">     
                            <div class="card-header">
                                <h3 class="card-title">Tình trạng xe</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">    
                                <div class="row">
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <img class="rounded mx-auto d-block" alt="" id="image1" width="100%">
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ảnh 1</span>
                                            <input name="image_url_1" class="form-control" type="file" id="imageFile" onchange="chooseFile1(this)" accept="image/jpeg, image/png">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <img src="" class="rounded mx-auto d-block" alt="" id="image2" width="100%">
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ảnh 2</span>
                                            <input name="image_url_2" class="form-control" type="file" id="imageFile" onchange="chooseFile2(this)" accept="image/jpeg, image/png">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <img src="" class="rounded mx-auto d-block" alt="" id="image3" width="100%">
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ảnh 3</span>
                                            <input name="image_url_3" class="form-control" type="file" id="imageFile" onchange="chooseFile3(this)" accept="image/jpeg, image/png">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <img src="" class="rounded mx-auto d-block" alt="" id="image4" width="100%">
                                        </div>
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ảnh 4</span>
                                            <input name="image_url_4" class="form-control" type="file" id="imageFile" onchange="chooseFile4(this)" accept="image/jpeg, image/png">
                                        </div>
                                    </div>
                                    <div class="box1 col-md-12">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Tổng kết</span>
                                            <input type="text" class="form-control" name="tinh_trang_xe" value="{{ old('tinh_trang_xe') ?? 'Tình trạng xe bàn giao tốt'}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer btn-group-sm">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu & In</button>
                                <a href="{{ route('admin.transfer.index') }}" class="btn btn-danger"><i class="fa-solid fa-xmark"></i> Thoát</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </section> 
    </form>
</div>
@endsection

@section('title')
Biên bản bàn giao xe
@endsection

@section('js-custom')
<script type="text/javascript">

    function chooseFile1(fileInput){
        if(fileInput.files && fileInput.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image1').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    function chooseFile2(fileInput){
        if(fileInput.files && fileInput.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image2').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    function chooseFile3(fileInput){
        if(fileInput.files && fileInput.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image3').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    function chooseFile4(fileInput){
        if(fileInput.files && fileInput.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image4').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
            
    $(document).bind("keyup keydown", function(e){
        if(e.ctrlKey && e.keyCode == 80){            
            $(".printer").css("opacity","0");
            $(".select2-selection__arrow").css("opacity","0");
            $(".printer-hidden").hide();
            window.print();
            $(".printer").css("opacity","1");
            $(".select2-selection__arrow").css("opacity","1");
            $(".printer-hidden").show();
            return false;
        }
    });
    
    $(document).ready(function(){
        $('.toast').toast('show');

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });
    })
</script>
@endsection