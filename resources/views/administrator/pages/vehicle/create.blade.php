@extends('administrator.layout.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Phương tiện - Thêm mới</h1>
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
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Khai báo thông tin</h3>
                                <div class="card-tools"></div>
                            </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- {{ $errors ?? dd($errors->all()) }} --}}
                        <form role="form" method="POST" action="{{ route('admin.vehicle.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">    
                                <div class="row">
                                    <div class="box1 col-md-3">                             
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Số xe</span>
                                            <input type="text"  name="so_xe" class="form-control msg-white" value="{{ old('so_xe') }}" data-masked="" data-inputmask="'mask': '99a-999.99'" autofocus required>
                                        </div>
                                        <x-input-error :messages="$errors->get('so_xe')" class="mt-2" style="color: red"/>                                    
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Loại thùng</span>
                                            <input type="text"  name="loai_thung" class="form-control msg-white" value="{{ old('loai_thung') }}" required>
                                        </div>
                                        <x-input-error :messages="$errors->get('loai_thung')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Máy lạnh</span>
                                            <input type="text"  name="may_lanh" class="form-control msg-white" value="{{ old('may_lanh') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('may_lanh')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Nhãn hiệu</span>
                                            <input type="text"  name="nhan_hieu" class="form-control msg-white" value="{{ old('nhan_hieu') }}" required>
                                        </div>
                                        <x-input-error :messages="$errors->get('nhan_hieu')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Màu sơn</span>
                                            <input type="text"  name="mau_son" class="form-control msg-white" value="{{ old('mau_son') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('mau_son')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ảnh</span>
                                            <input type="file"  name="image_url_1" class="inputfile" id='file1' onchange="chooseFile1(this)" accept="image/jpeg, image/png" />
                                            <label for="file1" id="show1" class="form-control">Chọn ảnh 1</label>
                                            <input type="file"  name="image_url_2" class="inputfile" id='file2' onchange="chooseFile2(this)" accept="image/jpeg, image/png" />
                                            <label for="file2" id="show2" class="form-control">Chọn ảnh 2</label>
                                        </div>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Số máy</span>
                                            <input type="text"  name="so_may" class="form-control msg-white" value="{{ old('so_may') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('so_may')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Số khung</span>
                                            <input type="text"  name="so_khung" class="form-control msg-white" value="{{ old('so_khung') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('so_khung')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Năm sản xuất</span>
                                            <input type="text"  name="nam_sx" class="form-control msg-white" value="{{ old('nam_sx') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('nam_sx')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Niên hạn</span>
                                            <input type="text"  name="nien_han" class="form-control msg-white" value="{{ old('nien_han') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('nien_han')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Công thức bánh xe</span>
                                            <input type="text"  name="cong_thuc_banh_xe" class="form-control msg-white" value="{{ old('cong_thuc_banh_xe') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('cong_thuc_banh_xe')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">K. thước bao</span>
                                            <input type="text"  name="kich_thuoc_bao" class="form-control msg-white" value="{{ old('kich_thuoc_bao') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('kich_thuoc_bao')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">K. thước lòng thùng</span>
                                            <input type="text"  name="kich_thuoc_long_thung" class="form-control msg-white" value="{{ old('kich_thuoc_long_thung') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('kich_thuoc_long_thung')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-4">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Chiều dài cơ sở</span>
                                            <input type="text"  name="chieu_dai_co_so" class="form-control msg-white" value="{{ old('chieu_dai_co_so') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('chieu_dai_co_so')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">K. lượng bản thân</span>
                                            <input type="text"  name="khoi_luong_ban_than" class="form-control msg-white" value="{{ old('khoi_luong_ban_than') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('khoi_luong_ban_than')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">K. lượng hàng hóa</span>
                                            <input type="text"  name="khoi_luong_hang_hoa" class="form-control msg-white" value="{{ old('khoi_luong_hang_hoa') }}" required>
                                        </div>
                                        <x-input-error :messages="$errors->get('khoi_luong_hang_hoa')" class="mt-2" style="color: red"/>
                                    </div>                            
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">K. lượng toàn bộ</span>
                                            <input type="text"  name="khoi_luong_toan_bo" class="form-control msg-white" value="{{ old('khoi_luong_toan_bo') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('khoi_luong_toan_bo')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">K. lượng kéo theo</span>
                                            <input type="text"  name="khoi_luong_keo_theo" class="form-control msg-white" value="{{ old('khoi_luong_keo_theo') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('khoi_luong_keo_theo')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Số người (chở)</span>
                                            <input type="text"  name="so_nguoi_cho" class="form-control msg-white" value="{{ old('so_nguoi_cho') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('so_nguoi_cho')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Loại nhiên liệu</span>
                                            <input type="text"  name="loai_nhien_lieu" class="form-control msg-white" value="Diesel">
                                        </div>
                                        <x-input-error :messages="$errors->get('loai_nhien_lieu')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Định mức nhiên liệu</span>
                                            <input type="text"  name="dinh_muc_tb" class="form-control msg-white" value="{{ old('dinh_muc_tb') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('dinh_muc_tb')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Định mức thay nhớt</span>
                                            <input type="text"  name="dinh_muc_thay_nhot" class="form-control msg-white" value="{{ old('dinh_muc_thay_nhot') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('dinh_muc_thay_nhot')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Hiệu lực kiểm định</span>
                                            <input class="form-control datepicker" type="text" name="hieu_luc_kiem_dinh" value="{{ old('hieu_luc_kiem_dinh') }}" data-masked="" data-inputmask="'mask': '99/99/9999'" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('hieu_luc_kiem_dinh')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Hiệu lực ngân hàng</span>
                                            <input class="form-control datepicker" type="text" name="hieu_luc_ngan_hang" value="{{ old('hieu_luc_ngan_hang') }}" data-masked="" data-inputmask="'mask': '99/99/9999'" />
                                        </div>
                                        <x-input-error :messages="$errors->get('hieu_luc_ngan_hang')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Hiệu lực BHDS</span>
                                            <input class="form-control datepicker" type="text" name="hieu_luc_bhds" value="{{ old('hieu_luc_bhds') }}" data-masked="" data-inputmask="'mask': '99/99/9999'" />
                                        </div>
                                        <x-input-error :messages="$errors->get('hieu_luc_bhds')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Công ty BHDS</span>
                                            <input type="text"  name="cong_ty_bhds" class="form-control msg-white" value="{{ old('cong_ty_bhds') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('cong_ty_bhds')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Hiệu lực BHVC</span>
                                            <input class="form-control datepicker" type="text" name="hieu_luc_bhvc" value="{{ old('hieu_luc_bhvc') }}" data-masked="" data-inputmask="'mask': '99/99/9999'" />
                                        </div>
                                        <x-input-error :messages="$errors->get('hieu_luc_bhvc')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-3">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Công ty BHVC</span>
                                            <input type="text"  name="cong_ty_bhvc" class="form-control msg-white" value="{{ old('cong_ty_bhvc') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('cong_ty_bhvc')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text" for="unit_id">Đơn vị trực thuộc</span>
                                            <select class="form-select" id="unit_id" name="unit_id">
                                                <option value="">--Lựa chọn--</option>
                                                @foreach ($units as $unit)
                                                    <option {{ old('unit_id') == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->don_vi }}</option>  
                                                @endforeach  
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('unit_id')" class="mt-2" style="color: red"/>
                                    </div>
                                    <div class="box1 col-md-6">
                                        <div class="input-group mb-3 input-group-sm">
                                            <span class="input-group-text">Ngày mua</span>
                                            <input class="form-control datepicker" type="text" name="ngay_mua" value="{{ old('ngay_mua') }}" data-masked="" data-inputmask="'mask': '99/99/9999'" required autocomplete="off"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('ngay_mua')" class="mt-2" style="color: red"/>
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