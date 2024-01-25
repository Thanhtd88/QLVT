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
                        <div class="card-body">    
                            <div class="row">
                                <div class="box1 col-md-3">                             
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số xe</span>
                                        </div>
                                        <input type="text"  name="so_xe" class="form-control msg-white" value="{{ old('so_xe') }}">
                                        @error('so_xe') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>                                    
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Loại thùng</span>
                                        </div>
                                        <input type="text" name="loai_thung" class="form-control msg-white" value="{{ old('loai_thung') }}">
                                        @error('loai_thung') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Màu sơn</span>
                                        </div>
                                        <input type="text" name="mau_son" class="form-control msg-white" value="{{ old('mau_son') }}">
                                        @error('mau_son') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Nhãn hiệu</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" name="nhan_hieu" value="{{ old('nhan_hieu') }}">
                                        @error('nhan_hieu') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số loại</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" name="so_loai" value="{{ old('so_loai') }}">
                                        @error('so_loai') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số máy</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" name="so_may" value="{{ old('so_may') }}">
                                        @error('so_may') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số khung</span>
                                        </div>
                                        <input type="text" class="form-control text-upper msg-white" name="so_khung" value="{{ old('so_khung') }}">
                                        @error('so_khung') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Năm sản xuất</span>
                                        </div>
                                        <input type="number" class="form-control msg-white" name="nam_sx" value="{{ old('nam_sx') }}">
                                        @error('nam_sx') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Niên hạn</span>
                                        </div>
                                        <input type="number" class="form-control msg-white" name="nien_han" value="{{ old('nien_han') }}">
                                        @error('nien_han') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Công thức bánh xe</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="cong_thuc_banh_xe" value="{{ old('cong_thuc_banh_xe') }}">
                                        @error('cong_thuc_banh_xe') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">K. thước bao</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="kich_thuoc_bao" value="{{ old('kich_thuoc_bao') }}">
                                        @error('kich_thuoc_bao') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">K. thước lòng thùng</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="kich_thuoc_long_thung" value="{{ old('kich_thuoc_long_thung') }}">
                                        @error('kich_thuoc_long_thung') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Chiều dài cơ sở</span>
                                        </div>
                                        <input type="number" class="form-control msg-white" name="chieu_dai_co_so" value="{{ old('chieu_dai_co_so') }}">
                                        @error('chieu_dai_co_so') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">K. lượng bản thân</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="khoi_luong_ban_than" value="{{ old('khoi_luong_ban_than') }}">
                                        @error('khoi_luong_ban_than') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">K. lượng hàng hóa</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="khoi_luong_hang_hoa" value="{{ old('khoi_luong_hang_hoa') }}">
                                        @error('khoi_luong_hang_hoa') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>                            
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">K. lượng toàn bộ</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="khoi_luong_toan_bo" value="{{ old('khoi_luong_toan_bo') }}">
                                        @error('khoi_luong_toan_bo') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">K. lượng kéo theo</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="khoi_luong_keo_theo" value="{{ old('khoi_luong)keo_theo') }}">
                                        @error('khoi_luong_keo_theo') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Số người (chở)</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="so_nguoi_cho" value="{{ old('so_nguoi_cho') }}">
                                        @error('so_nguoi_cho') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Loại nhiên liệu</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="loai_nhien_lieu" value="Diesel">
                                        @error('loai_nhien_lieu') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Định mức nhiên liệu</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="dinh_muc_tb" value="{{ old('dinh_muc_tb') }}">
                                        @error('dinh_muc_tb') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Định mức thay nhớt</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="dinh_muc_thay_nhot" value="{{ old('dinh_muc_thay_nhot') }}">
                                        @error('dinh_muc_thay_nhot') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="hieu_luc_kiem_dinh" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hiệu lực kiểm định</span>
                                            </div>
                                                <input name="hieu_luc_kiem_dinh" type="text" value="{{ old('hieu_luc_kiem_dinh') }}" class="form-control datetimepicker-input" data-target="#hieu_luc_kiem_dinh"/>
                                            <div class="input-group-append" data-target="#hieu_luc_kiem_dinh" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            @error('hieu_luc_kiem_dinh') <span style="color: red">{{ ' *'.$message }}</span>@enderror
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
                                            @error('hieu_luc_ngan_hang') <span style="color: red">{{ ' *'.$message }}</span>@enderror
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
                                            @error('hieu_luc_bhds') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Công ty BHDS</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="cong_ty_bhds" value="{{ old('cong_ty_bhds') }}">
                                        @error('cong_ty_bhds') <span style="color: red">{{ ' *'.$message }}</span>@enderror
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
                                            @error('hieu_luc_bhvc') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Công ty BHVC</span>
                                        </div>
                                        <input type="text" class="form-control msg-white" name="cong_ty_bhvc" value="{{ old('cong_ty_bhvc') }}">
                                        @error('cong_ty_bhvc') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="box1 col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Đơn vị trực thuộc</span>
                                        </div>
                                        <select class="custom-select" name="unit_id">
                                            <option value="">--Lựa chọn--</option>
                                            @foreach ($units as $unit)
                                                <option {{ old('unit_id') == $unit->id ? 'selected' : '' }} value="{{ $unit->id }}">{{ $unit->don_vi }}</option>  
                                            @endforeach  
                                        </select>    
                                        @error('unit_id')<span style="color: red;">{{ '*'.$message }}</span>@enderror             
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_mua" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ngày mua</span>
                                            </div>
                                            <input name="ngay_mua" type="text" value="{{ old('ngay_mua') }}" class="form-control datetimepicker-input" data-target="#ngay_mua"/>
                                            <div class="input-group-append" data-target="#ngay_mua" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            @error('ngay_mua') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="box1 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group date reservationdate" id="ngay_ban" data-target-input="nearest">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Ngày bán</span>
                                            </div>
                                            <input name="ngay_ban" type="text" value="{{ old('ngay_ban') }}" class="form-control datetimepicker-input" data-target="#ngay_ban" />
                                            <div class="input-group-append" data-target="#ngay_ban" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                            </div>
                                            @error('ngay_ban') <span style="color: red">{{ ' *'.$message }}</span>@enderror
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
                                        @error('trang_thai') <span style="color: red">{{ ' *'.$message }}</span>@enderror
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