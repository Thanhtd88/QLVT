@extends('administrator.layout.master')

@section('content')
@if (session('msg'))
  @include('administrator.pages.notification')
@endif
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Phương tiện - Cập nhật</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.vehicle.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin phương tiện</h3>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('admin.vehicle.update', ['vehicle' => $vehicle->id]) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card-body" style="display: block;">    
                            <div class="row">
                                <div class="box1 col-md-3">                             
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số xe</span>
                                        <input type="text"  name="so_xe" class="form-control msg-white" value="{{ old('so_xe') ?? $vehicle->so_xe }}" readonly>
                                    </div>  
                                    <x-input-error :messages="$errors->get('so_xe')" class="mt-2" style="color: red"/>                                  
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Loại thùng</span>
                                        <input value="{{ old('loai_thung') ?? $vehicle->loai_thung }}" type="text" name="loai_thung" class="form-control msg-white" required>
                                    </div>  
                                    <x-input-error :messages="$errors->get('loai_thung')" class="mt-2" style="color: red"/>       
                                </div>                                
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Máy lạnh</span>
                                        <input value="{{ old('may_lanh') ?? $vehicle->may_lanh }}" type="text" name="may_lanh" class="form-control msg-white" name="may_lanh">
                                    </div>
                                    <x-input-error :messages="$errors->get('may_lanh')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Nhãn hiệu</span>
                                        <input value="{{ old('nhan_hieu') ?? $vehicle->nhan_hieu }}" type="text" name="nhan_hieu" class="form-control msg-white" name="nhan_hieu" required>
                                    </div>
                                    <x-input-error :messages="$errors->get('nhan_hieu')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Màu sơn</span>
                                        <input value="{{ old('mau_son') ?? $vehicle->mau_son }}" type="text" name="mau_son" class="form-control msg-white" name="mau_son">
                                    </div>
                                    <x-input-error :messages="$errors->get('mau_son')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Ảnh</span>
                                        <input type="file"  name="image_url_1" class="inputfile" id='file1' onchange="chooseFile1(this)" accept="image/jpeg, image/png" />
                                        <label for="file1" id="show1" class="form-control">Chọn ảnh</label>
                                        <input type="file"  name="image_url_2" class="inputfile" id='file2' onchange="chooseFile2(this)" accept="image/jpeg, image/png" />
                                        <label for="file2" id="show2" class="form-control">Chọn ảnh</label>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số máy</span>
                                        <input value="{{ old('so_may') ?? $vehicle->so_may }}" type="text" class="form-control text-upper msg-white" name="so_may">
                                    </div>
                                    <x-input-error :messages="$errors->get('so_may')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số khung</span>
                                        <input value="{{ old('so_khung') ?? $vehicle->so_khung }}" type="text" class="form-control text-upper msg-white" name="so_khung">
                                    </div>
                                    <x-input-error :messages="$errors->get('so_khung')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Năm sản xuất</span>
                                        <input value="{{ old('nam_sx') ?? $vehicle->nam_sx }}" type="number" class="form-control msg-white" name="nam_sx">
                                    </div>
                                    <x-input-error :messages="$errors->get('nam_sx')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Niên hạn</span>
                                        <input value="{{ old('nien_han') ?? $vehicle->nien_han }}" type="number" class="form-control msg-white" name="nien_han">
                                    </div>
                                    <x-input-error :messages="$errors->get('nien_han')" class="mt-2" style="color: red"/> 
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Công thức bánh xe</span>
                                        <input value="{{ old('cong_thuc_banh_xe') ?? $vehicle->cong_thuc_banh_xe }}" type="text" class="form-control msg-white" name="cong_thuc_banh_xe">
                                    </div>
                                    <x-input-error :messages="$errors->get('cong_thuc_banh_xe')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Kích thước bao</span>
                                        <input value="{{ old('kich_thuoc_bao') ?? $vehicle->kich_thuoc_bao }}" type="text" class="form-control msg-white" name="kich_thuoc_bao">
                                    </div>
                                    <x-input-error :messages="$errors->get('kich_thuoc_bao')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Kích thước lòng thùng</span>
                                        <input value="{{ old('kich_thuoc_long_thung') ?? $vehicle->kich_thuoc_long_thung }}" type="text" class="form-control msg-white" name="kich_thuoc_long_thung">
                                    </div>
                                    <x-input-error :messages="$errors->get('kich_thuoc_long_thung')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Chiều dài cơ sở</span>
                                        <input value="{{ old('chieu_dai_co_so') ?? $vehicle->chieu_dai_co_so }}" type="number" class="form-control msg-white" name="chieu_dai_co_so">
                                    </div>
                                    <x-input-error :messages="$errors->get('chieu_dai_co_so')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Khối lượng bản thân</span>
                                        <input value="{{ old('khoi_luong_ban_than') ?? $vehicle->khoi_luong_ban_than }}" type="text" class="form-control msg-white" name="khoi_luong_ban_than">
                                    </div>
                                    <x-input-error :messages="$errors->get('khoi_luong_ban_than')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Khối lượng hàng hóa</span>
                                        <input value="{{ old('khoi_luong_hang_hoa') ?? $vehicle->khoi_luong_hang_hoa }}" type="text" class="form-control msg-white" name="khoi_luong_hang_hoa" required>
                                    </div>
                                    <x-input-error :messages="$errors->get('khoi_luong_hang_hoa')" class="mt-2" style="color: red"/>
                                </div>                            
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Khối lượng toàn bộ</span>
                                        <input value="{{ old('khoi_luong_toan_bo') ?? $vehicle->khoi_luong_toan_bo }}" type="text" class="form-control msg-white" name="khoi_luong_toan_bo">
                                    </div>
                                    <x-input-error :messages="$errors->get('khoi_luong_toan_bo')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Khối lượng kéo theo</span>
                                        <input value="{{ old('khoi_luong_keo_theo') ?? $vehicle->khoi_luong_keo_theo }}" type="text" class="form-control msg-white" name="khoi_luong_keo_theo">
                                    </div>
                                    <x-input-error :messages="$errors->get('khoi_luong_keo_theo')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Số người được phép chở</span>
                                        <input value="{{ old('so_nguoi_cho') ?? $vehicle->so_nguoi_cho }}" type="text" class="form-control msg-white" name="so_nguoi_cho">
                                    </div>
                                    <x-input-error :messages="$errors->get('so_nguoi_cho')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Loại nhiên liệu</span>
                                        <input value="{{ old('loai_nhien_lieu') ?? $vehicle->loai_nhien_lieu }}" type="text" class="form-control msg-white" name="loai_nhien_lieu" value="Diesel">
                                    </div>
                                    <x-input-error :messages="$errors->get('loai_nhien_lieu')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Định mức nhiên liệu</span>
                                        <input value="{{ old('dinh_muc_tb') ?? $vehicle->dinh_muc_tb }}" type="text" class="form-control msg-white" name="dinh_muc_tb">
                                    </div>
                                    <x-input-error :messages="$errors->get('dinh_muc_tb')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Định mức thay nhớt</span>
                                        <input value="{{ old('dinh_muc_thay_nhot') ?? $vehicle->dinh_muc_thay_nhot }}" type="text" class="form-control msg-white" name="dinh_muc_thay_nhot">
                                    </div>
                                    <x-input-error :messages="$errors->get('dinh_muc_thay_nhot')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Hiệu lực kiểm định</span>
                                        <input class="form-control datepicker" type="text" name="hieu_luc_kiem_dinh" value="{{ old('hieu_luc_kiem_dinh') ?? is_null($vehicle->hieu_luc_kiem_dinh) ? '' : date('d/m/Y', strtotime($vehicle->hieu_luc_kiem_dinh)) }}" data-masked="" data-inputmask="'mask': '99/99/9999'" required autocomplete="off" />
                                    </div>
                                    <x-input-error :messages="$errors->get('hieu_luc_kiem_dinh')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Hiệu lực ngân hàng</span>
                                        <input class="form-control datepicker" type="text" name="hieu_luc_ngan_hang" value="{{ old('hieu_luc_ngan_hang') ?? is_null($vehicle->hieu_luc_ngan_hang) ? '' : date('d/m/Y', strtotime($vehicle->hieu_luc_ngan_hang)) }}" data-masked="" data-inputmask="'mask': '99/99/9999'" autocomplete="off" />
                                    </div>
                                    <x-input-error :messages="$errors->get('hieu_luc_ngan_hang')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Hiệu lực BHDS</span>
                                        <input class="form-control datepicker" type="text" name="hieu_luc_bhds" value="{{ old('hieu_luc_bhds') ?? is_null($vehicle->hieu_luc_bhds) ? '' : date('d/m/Y', strtotime($vehicle->hieu_luc_bhds)) }}" data-masked="" data-inputmask="'mask': '99/99/9999'" required autocomplete="off" />
                                    </div>
                                    <x-input-error :messages="$errors->get('hieu_luc_bhds')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Công ty BHDS</span>
                                        <input value="{{ old('cong_ty_bhds') ?? $vehicle->cong_ty_bhds }}" type="text" class="form-control msg-white" name="cong_ty_bhds">
                                    </div>
                                    <x-input-error :messages="$errors->get('cong_ty_bhds')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Hiệu lực BHVC</span>
                                        <input class="form-control datepicker" type="text" name="hieu_luc_bhvc" value="{{ old('hieu_luc_bhvc') ?? is_null($vehicle->hieu_luc_bhvc) ? '' : date('d/m/Y', strtotime($vehicle->hieu_luc_bhvc)) }}" data-masked="" data-inputmask="'mask': '99/99/9999'" autocomplete="off" />
                                    </div>
                                    <x-input-error :messages="$errors->get('hieu_luc_bhvc')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Công ty BHVC</span>
                                        <input value="{{ old('cong_ty_bhvc') ?? $vehicle->cong_ty_bhvc }}" type="text" class="form-control msg-white" name="cong_ty_bhvc">
                                    </div>
                                    <x-input-error :messages="$errors->get('cong_ty_bhvc')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Đơn vị trực thuộc</span>
                                        <select class="form-select" name="unit_id">
                                            <option value="">--- Vui lòng chọn đơn vị ---</option>
                                            @foreach ($units as $unit)
                                                <option {{ old('unit_id') ?? $vehicle->unit_id == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->don_vi }}</option>  
                                            @endforeach  
                                        </select> 
                                    </div>
                                    <x-input-error :messages="$errors->get('unit_id')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3 input-group-sm">
                                        <span class="input-group-text">Ngày mua</span>
                                        <input class="form-control datepicker" type="text" name="ngay_mua" value="{{ old('ngay_mua') ?? is_null($vehicle->ngay_mua) ? '' : date('d/m/Y', strtotime($vehicle->ngay_mua)) }}" data-masked="" data-inputmask="'mask': '99/99/9999'" autocomplete="off" />
                                    </div>
                                    <x-input-error :messages="$errors->get('ngay_mua')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group date input-group-sm">
                                        <span class="input-group-text">Ngày bán</span>
                                        <input type="text" class="form-control datepicker" value="{{ old('ngay_ban') ?? is_null($vehicle->ngay_ban) ? '' : date('d/m/Y', strtotime($vehicle->ngay_ban)) }}" name="ngay_ban" data-masked="" data-inputmask="'mask': '99/99/9999'" autocomplete="off">
                                    </div>
                                    <x-input-error :messages="$errors->get('ngay_ban')" class="mt-2" style="color: red"/>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
      
                        <div class="card-footer btn-group-sm">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('admin.vehicle.index') }}" class="btn btn-danger"><i class="fas fa-times"></i> Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </section> 
</div>
@endsection

@section('title')
    Phương tiện
@endsection

@section('js-custom')
<script>
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

    $(function () {
        $('.toast').toast('show');

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy'
        });

        $(":input").inputmask();

        var inputs_1 = document.querySelectorAll( '#file1' );            
        Array.prototype.forEach.call( inputs_1, function( input )
        {
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;
            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 0 )
                    fileName = `<img class="rounded mx-auto d-block" alt="" id="image1" height="100%">`;
                if( fileName )
                    document.getElementById( 'show1' ).innerHTML = fileName;
                else
                    document.getElementById( 'show1' ).innerHTML = labelVal;
            });
        });

        var inputs_2 = document.querySelectorAll( '#file2' );            
        Array.prototype.forEach.call( inputs_2, function( input )
        {
            var label	 = input.nextElementSibling,
                labelVal = label.innerHTML;
            input.addEventListener( 'change', function( e )
            {
                var fileName = '';
                if( this.files && this.files.length > 0 )
                    fileName = `<img class="rounded mx-auto d-block" alt="" id="image2" height="100%">`;
                if( fileName )
                    document.getElementById( 'show2' ).innerHTML = fileName;
                else
                    document.getElementById( 'show2' ).innerHTML = labelVal;
            });
        });
    })
</script>
@endsection