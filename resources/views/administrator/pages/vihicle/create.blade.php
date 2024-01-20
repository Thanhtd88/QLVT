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
              <li class="breadcrumb-item"><a href="{{ route('admin.vihicle.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Khai báo phương tiện mới</h3>
                            <div class="card-tools"></div>
                        </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- {{ $errors ?? dd($errors->all()) }} --}}
                    <form role="form" method="POST" action="{{ route('admin.vihicle.store') }}">
                        @csrf
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="box1 col-md-3">                             
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số xe</span>
                                        </div>
                                        <input type="text"  name="so_xe" class="form-control msg-white" @error('so_xe') placeholder="{{ old('so_xe').' '.$message }}" style="background: red;" @enderror >
                                    </div>                                    
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Loại thùng</span>
                                        </div>
                                        <input type="text" name="loai_thung" class="form-control msg-white" @error('loai_thung') placeholder="{{ $message }}" style="background: red;" @enderror>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Màu sơn</span>
                                        </div>
                                        <input type="text" name="mau_son" class="form-control msg-white" @error('mau_son') placeholder="{{ $message }}" style="background: red;" @enderror>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nhãn hiệu</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" @error('nhan_hieu') placeholder="{{ $message }}" style="background: red;" @enderror name="nhan_hieu">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số loại</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" @error('so_loai') placeholder="{{ $message }}" style="background: red;" @enderror name="so_loai">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số máy</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" @error('so_may') placeholder="{{ $message }}" style="background: red;" @enderror name="so_may">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số khung</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" @error('so_khung') placeholder="{{ $message }}" style="background: red;" @enderror name="so_khung">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Năm sản xuất</span>
                                        </div>
                                        <input type="number" class="form-control msg-white" @error('nam_sx') placeholder="{{ $message }}" style="background: red;" @enderror name="nam_sx">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Niên hạn</span>
                                        </div>
                                        <input type="number" class="form-control msg-white" @error('nien_han') placeholder="{{ $message }}" style="background: red;" @enderror name="nien_han">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Công thức bánh xe</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('cong_thuc_banh_xe') placeholder="{{ $message }}" style="background: red;" @enderror name="cong_thuc_banh_xe">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Kích thước bao</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('kich_thuoc_bao') placeholder="{{ $message }}" style="background: red;" @enderror name="kich_thuoc_bao">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Kích thước lòng thùng</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('kich_thuoc_long_thung') placeholder="{{ $message }}" style="background: red;" @enderror name="kich_thuoc_long_thung">
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Chiều dài cơ sở</span>
                                        </div>
                                        <input type="number" class="form-control msg-white" @error('chieu_dai_co_so') placeholder="{{ $message }}" style="background: red;" @enderror name="chieu_dai_co_so">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Khối lượng bản thân</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('khoi_luong_ban_than') placeholder="{{ $message }}" style="background: red;" @enderror name="khoi_luong_ban_than">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Khối lượng hàng hóa</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('khoi_luong_hang_hoa') placeholder="{{ $message }}" style="background: red;" @enderror name="khoi_luong_hang_hoa">
                                    </div>
                                </div>                            
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Khối lượng toàn bộ</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('khoi_luong_toan_bo') placeholder="{{ $message }}" style="background: red;" @enderror name="khoi_luong_toan_bo">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Khối lượng kéo theo</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('khoi_luong_keo_theo') placeholder="{{ $message }}" style="background: red;" @enderror name="khoi_luong_keo_theo">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số người được phép chở</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('so_nguoi_cho') placeholder="{{ $message }}" style="background: red;" @enderror name="so_nguoi_cho">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Loại nhiên liệu</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('loai_nhien_lieu') placeholder="{{ $message }}" style="background: red;" @enderror name="loai_nhien_lieu" value="Diesel">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Định mức nhiên liệu</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('dinh_muc_tb') placeholder="{{ $message }}" style="background: red;" @enderror name="dinh_muc_tb">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Định mức thay nhớt</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('dinh_muc_thay_nhot') placeholder="{{ $message }}" style="background: red;" @enderror name="dinh_muc_thay_nhot">
                                    </div>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="hieu_luc_kiem_dinh" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hiệu lực kiểm định</span>
                                            </div>
                                                <input name="hieu_luc_kiem_dinh" type="text" value="{{ old('hieu_luc_kiem_dinh') }}" class="form-control datetimepicker-input" data-target="#hieu_luc_kiem_dinh" @error('hieu_luc_kiem_dinh') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                            <div class="input-group-append" data-target="#hieu_luc_kiem_dinh" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="hieu_luc_ngan_hang" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hiệu lực ngân hàng</span>
                                            </div>
                                                <input name="hieu_luc_ngan_hang" type="text" value="{{ old('hieu_luc_ngan_hang') }}" class="form-control datetimepicker-input" data-target="#hieu_luc_ngan_hang" @error('hieu_luc_ngan_hang') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                            <div class="input-group-append" data-target="#hieu_luc_ngan_hang" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="hieu_luc_bhds" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hiệu lực BHDS</span>
                                            </div>
                                                <input name="hieu_luc_bhds" type="text" value="{{ old('hieu_luc_bhds') }}" class="form-control datetimepicker-input" data-target="#hieu_luc_bhds" @error('hieu_luc_bhds') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                            <div class="input-group-append" data-target="#hieu_luc_bhds" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Công ty BHDS</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('cong_ty_bhds') placeholder="{{ $message }}" style="background: red;" @enderror name="cong_ty_bhds">
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="hieu_luc_bhvc" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hiệu lực BHVC</span>
                                            </div>
                                            <input name="hieu_luc_bhvc" type="text" value="{{ old('hieu_luc_bhvc') }}" class="form-control datetimepicker-input" data-target="#hieu_luc_bhvc" @error('hieu_luc_bhvc') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                            <div class="input-group-append" data-target="#hieu_luc_bhvc" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Công ty BHVC</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" @error('cong_ty_bhvc') placeholder="{{ $message }}" style="background: red;" @enderror name="cong_ty_bhvc">
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Đơn vị trực thuộc</span>
                                        </div>
                                        <select class="custom-select" name="unit_id">
                                            <option value="">--- Vui lòng chọn đơn vị ---</option>
                                            @foreach ($units as $unit)
                                                <option {{ old('unit_id') == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->don_vi }}</option>  
                                            @endforeach  
                                        </select>                                        
                                        @error('unit_id')
                                            <span style="color: red; font-size: 14px">{{ $message }}</span>                                            
                                        @enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_mua" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ngày mua</span>
                                            </div>
                                            <input name="ngay_mua" type="text" value="{{ old('ngay_mua') }}" class="form-control datetimepicker-input" data-target="#ngay_mua" @error('ngay_mua') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                            <div class="input-group-append" data-target="#ngay_mua" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_ban" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ngày bán</span>
                                            </div>
                                            <input name="ngay_ban" type="text" value="{{ old('ngay_ban') }}" class="form-control datetimepicker-input" data-target="#ngay_ban" @error('ngay_ban') placeholder="{{ $message }}" style="background: red;" @enderror/>
                                            <div class="input-group-append" data-target="#ngay_ban" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Trạng thái</span>
                                        </div>
                                        <select class="custom-select" name="trang_thai">
                                            <option {{ old('trang_thai') == '0' ? 'selected' : '' }} value="Hoạt động">Hoạt động</option>
                                            <option {{ old('trang_thai') == '1' ? 'selected' : '' }} value="Sửa chữa">Sửa chữa</option>
                                            <option {{ old('trang_thai') == '2' ? 'selected' : '' }} value="Tạm dừng">Tạm dừng</option>
                                        </select>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            <a href="{{ route('admin.vihicle.index') }}" class="btn btn-danger"><i class="fas fa-times"></i> Hủy</a>
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
    $(function () {
        $('.reservationdate').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    })
</script>
@endsection