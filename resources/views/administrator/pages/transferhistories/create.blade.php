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
<div class="content-wrapper text-lg">
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
            <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Biên bản bàn giao - Công ty TNHH Bình Minh Tải</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="col-md-12">
                                <table style="width:100%; font-size: 18px">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="col-md-12 box1 title-transfer">
                                                    <img src="{{ asset('administrator/dist/img/AdminBMTLogo.png') }}" alt="Logo" style="width: 80px">
                                                    <div class="header">
                                                        <p><strong>CÔNG TY TNHH BÌNH MINH TẢI</strong></p>
                                                        <span>69, Nguyên Hồng, P. 11, Q. Bình Thạnh, HCM</span>
                                                        <p>Số: <input style="border: none" type="text" value="BMT/ADX-BGX-{{ $maxId + 1 }}" name="so_bien_ban"></p>
                                                    </div>
                                                </div> 
                                            </td>
                                            <td>
                                                <div class="col-md-12 box1 title-transfer">
                                                    <div class="header" style="text-align:center; margin: auto">
                                                        <p><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></p>
                                                        <span>Độc lâp - Tự do - Hạnh phúc</span>
                                                        <p>---oOo---</p>
                                                    </div>
                                                </div> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                                
                                </div>                                                               
                                <div class="col-md-12 tranfer-title" style="text-align: center; margin: 20px auto">
                                    <h4><strong>BIÊN BẢN BÀN GIAO XE</strong></h4>
                                    <select name="loai_bien_ban" id="">
                                        <option value="">--Lựa chọn loại biên bản--</option>
                                        <option value="0">(Bàn giao)</option>
                                        <option value="1">(Thu hồi)</option>
                                    </select>
                                    @error('loai_bien_ban')
                                        <span style="color: red; font-size: 14px">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="content-transfer">
                                        <p>- Hôm nay vào lúc {{ date('H', strtotime($time)) ." giờ ". date('i', strtotime($time)) ." phút, ngày ". date('d/m/Y', strtotime($time))}}. Tại văn phòng công ty TNHH Bình Minh Tải - chi nhánh Bình Dương (7/14 Khu phố Bình Đức 2, Bình Hòa, Thuận An, Bình Dương). Chúng tôi gồm: </p>
                                    </div>
                                </div>
                                <div class="col-md-12 box1">
                                    <div class="content-transfer">
                                        <h5>A. Bên bàn giao</h5>
                                    </div>
                                    <div class="row border-content">
                                        <div class="col-md-12">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Họ tên:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <select class="form-control select2" style="" id="deliver" name="d_personal_id">
                                                                <option selected="selected"></option>
                                                                @foreach ($personals as $personal)
                                                                    <option value={{ $personal->id }}>{{ $personal->ma_nv .'-'. $personal->ho_ten }}</option>
                                                                @endforeach                                    
                                                            </select> 
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Ngày sinh:</label>
                                                            </div>                                                                
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_ngaysinh">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Địa chỉ:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="7">
                                                            <input type="text" class="form-group" id="d_diachi">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">SĐT:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_sdt">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">CCCD/CMND:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_cccd">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Ngày cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_ngay_cccd">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Nơi cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input type="text" class="form-group" id="d_noi_cccd">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">GPLX:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_gplx">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Ngày cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_ngay_gplx">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Nơi cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_noi_gplx">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Hạng:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="d_hang_gplx">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>                                 
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 box1">
                                    <div class="content-transfer">
                                        <h5>B. Bên nhận bàn giao</h5>
                                    </div>
                                    <div class="row border-content">
                                        <div class="col-md-12">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Họ tên:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <select class="form-control select2" style="" id="receiver" name="r_personal_id">
                                                                <option selected="selected"></option>
                                                                @foreach ($personals as $personal)
                                                                    <option value={{ $personal->id }}>{{ $personal->ma_nv .'-'. $personal->ho_ten }}</option>
                                                                @endforeach                                    
                                                            </select> 
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Ngày sinh:</label>
                                                            </div>                                                                
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_ngaysinh">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Địa chỉ:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="7">
                                                            <input type="text" class="form-group" id="r_diachi">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">SĐT:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_sdt">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">CCCD/CMND:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_cccd">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Ngày cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_ngay_cccd">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Nơi cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input type="text" class="form-group" id="r_noi_cccd">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">GPLX:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_gplx">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Ngày cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_ngay_gplx">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Nơi cấp:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_noi_gplx">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Hạng:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-group" id="r_hang_gplx">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>                                 
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                    <div class="content-transfer">
                                        <p>- Cùng tiến hành kiểm tra, đánh dấu xác nhận các phần từ 01 đến 06 và đồng ý ký vào biên bản này bàn giao cho BÊN NHẬN BÀN GIAO 01 xe với thông tin như sau:</p>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 box1">
                                    <div class="content-transfer">
                                        <h5>1. Thông tin xe</h5>
                                    </div>
                                    <div class="row border-content">
                                        <div class="col-md-12">
                                            <table style="width:100%">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Biển số:</label>
                                                            </div>
                                                        </td>                                                        
                                                        <td>
                                                            <select class="form-transform select2" style="" id="vihicle_giao" name="vihicle_id">
                                                                <option selected="selected"></option>
                                                                @foreach ($vihicles as $vihicle)
                                                                    <option value={{ $vihicle->id }}>{{ $vihicle->so_xe }}</option>
                                                                @endforeach                                    
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Tải trọng:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="taitrong" name="taitrong">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Loại:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="loaithung" name="loaithung">
                                                        </td>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Hiệu xe:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-upper" type="text" id="nhanhieu" name="nhanhieu">
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Số khung:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input class="text-upper" type="text" id="sokhung" name="sokhung">
                                                        </td>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Số máy:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input class="text-upper" type="text" id="somay" name="somay">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Năm sx:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="namsx" name="namsx">
                                                        </td>
                                                        <td></td><td></td>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Km (ODO):</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="number">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                               

                                <div class="col-md-12 box1">
                                    <div class="content-transfer">
                                        <h5>2. Giấy tờ xe</h5>
                                    </div>
                                    <div class="row border-content p-0">
                                        <div class="col-md-12">
                                            <table style="width:100%" class="transfer-table">
                                                <thead>
                                                    <tr>
                                                        <th style="padding: 0 30px; width: 80%">Tên</th>
                                                        <th  class="text-center" style="padding-left: 24px">Loại</th>
                                                        <th style="width: 40px; text-align:center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>                                                            
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Đăng ký xe</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="cavet" id="cavet">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Giấy chứng nhận kiểm định</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="dangkiem" id="dangkiem">
                                                                <option value="0" selected>Bản chính</option>
                                                                <option value="1">Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Giấy bảo hiểm bắt buộc TNDS</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="bhds" id="bhds">
                                                                <option value="0" selected>Bản chính</option>
                                                                <option value="1">Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Giấy phép đăng ký kinh doanh</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="dkkd" id="dkkd">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Hợp đồng vận chuyển</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="hopdong_vc" id="hopdong_vc">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Hợp đồng lao động</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="hopdong_ld" id="hopdong_ld">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Phù hiệu xe tải</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select name="phuhieu" id="phuhieu">
                                                                <option value="0" selected>Bản chính</option>
                                                                <option value="1">Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 box1">
                                    <div class="content-transfer">
                                        <h5>3. Trang bị theo xe</h5>
                                    </div>
                                    <div class="row border-content p-0">
                                        <div class="col-md-12">
                                            <table style="width:100%" class="transfer-table">
                                                <thead>
                                                    <th style="padding: 0 30px; width: 80%">Tên</th>
                                                    <th class="text-center">Số lượng</th>
                                                    <th style="width: 40px; text-align:center"></th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Bình ắc quy</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-center" type="number" id="" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Bánh dự phòng</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-center" type="number" id="" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="form-group">Thiết bị định vị</label>
                                                            </div>
                                                        </td>
                                                        <td><input class="text-center" type="number" id="" value="1"></td>
                                                    </tr>
                                                    <tr class="input-trang-bi printer-hidden">
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <select name="" id="new-trangbixe" class="form-group">
                                                                    <option value="">--- Lựa chọn ---</option>
                                                                    <option value="Bạt lót sàn">Bạt lót sàn</option>
                                                                    <option value="Pallet">Pallet</option>
                                                                    <option value="Thiết bị ghi nhiệt độ Logtag">Thiết bị ghi nhiệt độ Logtag</option>
                                                                    <option value="Bộ dụng cụ thay bánh xe">Bộ dụng cụ thay bánh xe</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-center" type="number" id="new-trangbixe-qty" value="0">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="add_field" id="add_field_xe"><i class="fas fa-plus"></i></button></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot id="trangbi_xe">                                            
                                                    <tr></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12 box1">
                                    <div class="content-transfer">
                                        <h5>4. Trang bị bảo hộ</h5>
                                    </div>
                                    <div class="row border-content p-0">
                                        <div class="col-md-12">
                                            <table style="width:100%" class="transfer-table">
                                                <thead>
                                                    <th style="padding: 0 30px; width: 80%">Tên</th>
                                                    <th class="text-center">Số lượng</th>
                                                    <th style="width: 40px; text-align:center"></th>
                                                    <tr class="input-bao-ho printer-hidden">
                                                        <td>
                                                            {{-- <select name="dongphuc" id="new-bhld">
                                                                <option value="">--- Lựa chọn ---</option>
                                                                <option value="Áo thun BMT">Áo thun BMT</option>
                                                                <option value="Áo sơ mi BMT">Áo sơ mi BMT</option>
                                                                <option value="Áo thun ADX">Áo thun ADX</option>
                                                                <option value="Áo sơ mi ADX">Áo sơ mi ADX</option>
                                                                <option value="Áo phản quang">Áo phản quang</option>
                                                                <option value="Giày bảo hộ">Giày bảo hộ</option>
                                                                <option value="Nón bảo hộ">Nón bảo hộ</option>
                                                                <option value="Cục canh bánh xe">Cục canh bánh xe</option>
                                                                <option value="Bình chữa cháy">Bình chữa cháy</option>
                                                                <option value="Tam giác phản quang">Tam giác phản quang</option>
                                                                <option value="Túi y tế">Túi y tế</option>                                                        
                                                            </select> --}}
                                                            <select class="form-control select2" style="" id="new-bhld" name="dongphuc">
                                                                <option value="" selected="selected">--Lựa chọn--</option>
                                                                @foreach ($warehouses as $warehouse)
                                                                    <option value="{{ $warehouse->vat_tu }}">{{ $warehouse->vat_tu }}</option>
                                                                @endforeach                                    
                                                            </select>
                                                        </td>
                                                        {{-- <td>
                                                            <select name="size" id="new-bhld-size">
                                                                <option value="">--- Lựa chọn ---</option>
                                                                <option value="S">S</option>
                                                                <option value="M">M</option>
                                                                <option value="L">L</option>
                                                                <option value="XL">XL</option>
                                                                <option value="XXL">XXL</option>
                                                                <option value="XXXL">XXXL</option>
                                                                <option value="40">40</option>
                                                                <option value="41">41</option>
                                                                <option value="42">42</option>
                                                                <option value="43">43</option>                                                      
                                                            </select>
                                                        </td> --}}
                                                        <td><input  class="text-center" id="new-bhld-qty" type="number" name="so_luong" value="1"></td>
                                                        <td>
                                                            <button type="button" id="add_field_bao_ho"><i class="fas fa-plus"></i></button>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody id="trangbi_baoho">
                                                    <tr class="input-trang-bi"></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="content-transfer">
                                        <h5>5. Tình trạng xe</h5>
                                    </div>
                                    <div class="row border-content">
                                        <div class="col-md-12">
                                            <table style="width:100%" class="transfer-table">
                                                <thead>
                                                    <th style="padding: 0 30px; width: 80%">Nội dung</th>
                                                    <th class="text-center" style="padding-left: 24px">Xác nhận</th>
                                                    <th style="width: 40px; text-align:center"></th>
                                                </thead>
                                                <tbody>
                                                    <tr class="form-info">
                                                        <td><label for="ngoaiquan">Bề ngoài xe sạch sẽ, không trầy, móp</label></td>
                                                        <td style="width: 420px;"><input type="checkbox" id="ngoaiquan" checked></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="form-info">
                                                        <td><label for="guong">Hệ thống đèn lái, xi-nhan, đèn hậu và đèn thùng đầy đủ</label></td>
                                                        <td><input type="checkbox" id="guong" checked></td>
                                                    </tr>
                                                    <tr class="form-info">
                                                        <td><label for="kinh">Kính hậu, Kính chắn gió không rạn nứt, bể</label></td>
                                                        <td><input type="checkbox" id="kinh" checked></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="content-transfer">
                                        <h5>6 .Tình trạng vỏ xe (Thứ tự tính từ đầu xe)</h5>
                                    </div>
                                    <div class="row border-content p-0">
                                        <div class="col-md-12">
                                            <table style="width:100%" class="table transfer-table">
                                                <thead>
                                                    <th style="padding-left: 30px">Vị trí</th>
                                                    <th class="text-center">Độ bền %</th>
                                                    <th >Ghi chú</th>
                                                    <th style="width: 40px; text-align:center">
                                                        <button type="button" id="add_field_vo_xe"><i class="fas fa-plus"></i></button>
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <tr class="form-info">
                                                        <td>Trục 1</td>
                                                        <td><input class="text-center" type="number" value="100"></td>
                                                        <td><input type="text"></td>
                                                    </tr>
                                                    <tr class="form-info">
                                                        <td>Trục 2</td>
                                                        <td><input class="text-center" type="number" value="100"></td>
                                                        <td><input type="text"></td>
                                                    </tr>
                                                    {{-- <tr id="list" class="input-vo-xe printer-hidden form-info">
                                                        <td>
                                                            <select name="vitri" id="voxe-truc">
                                                                <option value="">--- Lựa chọn ---</option>
                                                                <option value="Trục 3 (Xe 3 chân)">Trục 3 (Xe 3 chân)</option>
                                                                <option value="Trục 4 (Xe 4 chân)">Trục 4 (Xe 4 chân)</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="text-center" type="number" id="voxe-status">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="ghichu">
                                                        </td>
                                                        <td>
                                                            
                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                                <tfoot id="voxe">                                            
                                                    <tr></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="content-transfer">
                                        <div class="input-group mb-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Tổng kết:</span>
                                            </div>
                                            <input type="text" class="form-control" value="Tình trạng xe bàn giao tốt" name="tinh_trang_xe">
                                            </div>   
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="content-transfer">
                                        <p>- Đồng thời Lái xe cam kết có trách nhiệm chở hàng đúng theo lệnh điều động của Công ty. Nghiêm cấp việc chở hàng Quốc cấm. Có trách nhiệm bảo quản, giữ gìn tài sản được giao và lái xe an toàn.</p>
                                        <p>- Biên bản này được lập thành 02 (hai) bản có giá trị như nhau, mỗi bên giữ 01 (một) bản</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="card-body two-column" style="text-align: center">
                                            <div class="col-md-6">
                                                <br><span>Đại diện bên giao</span>
                                                <p style="font-size: 16px; font-style: italic">(Ký ghi rõ họ tên)</p>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <span>Bình Dương, ngày {{date('d', strtotime($time)) }} tháng {{date('m', strtotime($time)) }} năm {{date('Y', strtotime($time)) }}</span>
                                                <br><span>Đại diện bên nhận</span>
                                                <p style="font-size: 16px; font-style: italic">(Ký ghi rõ họ tên)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="card-footer printer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            <button type="button" id='printer' class="btn btn-success"><i class="fas fa-print"></i> In biên bản</button>
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
    $(function () {
        $('.select2').select2()  
    })
        
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

        $('#printer').click( function(){
            $(".printer").css("opacity","0");
            $(".select2-selection__arrow").css("opacity","0");
            $(".printer-hidden").hide();
            window.print();
            $(".printer").css("opacity","1");
            $(".select2-selection__arrow").css("opacity","1");
            $(".printer-hidden").show();
        })     

        $('#vihicle_giao').on('change', function(){
            var nameValue = $(this).val();        
            $.ajax({
                method: 'POST', // method of form
                url: '{{ route('admin.transfer.form.vihicle') }}',  // action of form
                data: {
                    vihicle_giao: nameValue,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    $('#taitrong').val(response.tai_trong);
                    $('#loaithung').val(response.loai_thung);
                    $('#nhanhieu').val(response.nhan_hieu);
                    $('#sokhung').val(response.so_khung);
                    $('#somay').val(response.so_may);
                    $('#namsx').val(response.nam_sx);
                }
            })            
        });

        $('#receiver').on('change', function(){
            var nameValue = $(this).val(); 
            $.ajax({
                method: 'POST', // method of form
                url: '{{ route('admin.transfer.form.receiver') }}',  // action of form
                data: {
                    receiver: nameValue,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    $('#r_ngaysinh').val(response.ngay_sinh);
                    $('#r_diachi').val(response.dia_chi);
                    $('#r_sdt').val(response.sdt);
                    $('#r_cccd').val(response.cccd);
                    $('#r_ngay_cccd').val(response.ngay_cap_cccd);
                    $('#r_noi_cccd').val(response.noi_cap_cccd);
                    $('#r_gplx').val(response.gplx);
                    $('#r_ngay_gplx').val(response.ngay_cap_gplx);
                    $('#r_noi_gplx').val(response.noi_cap_gplx);
                    $('#r_hang_gplx').val(response.hang_gplx);
                }
            })            
        });

        $('#deliver').on('change', function(){
            var nameValue = $(this).val(); 
            $.ajax({
                method: 'POST', // method of form
                url: '{{ route('admin.transfer.form.deliver') }}',  // action of form
                data: {
                    deliver: nameValue,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response){
                    $('#d_ngaysinh').val(response.ngay_sinh);
                    $('#d_diachi').val(response.dia_chi);
                    $('#d_sdt').val(response.sdt);
                    $('#d_cccd').val(response.cccd);
                    $('#d_ngay_cccd').val(response.ngay_cap_cccd);
                    $('#d_noi_cccd').val(response.noi_cap_cccd);
                    $('#d_gplx').val(response.gplx);
                    $('#d_ngay_gplx').val(response.ngay_cap_gplx);
                    $('#d_noi_gplx').val(response.noi_cap_gplx);
                    $('#d_hang_gplx').val(response.hang_gplx);
                }
            })            
        });   

        // Thêm thông tin trang bị bảo hộ lao động
        let trangBiBaoHo = []
        function callBackShowTrangBiBaoHo(){
            let xhtml_BHLD_list = ''
            trangBiBaoHo.map(function(value, index){
                xhtml_BHLD_list +=`<tr class="input-trang-bi form-info">
                    <td><label class="form-group">${value.name}</label></td>
                    <td><input class="text-center" type="number" value="${value.qty}"/></td>
                    <td class="printer-hidden"><button class="delete" data-id="${index}" style="color: red"><i class="fas fa-minus"</i></button></td>            
                </tr>`
            })
            $('#trangbi_baoho').html(xhtml_BHLD_list)
        }
        callBackShowTrangBiBaoHo()

        $(document).on('click', 'button#add_field_bao_ho', function(){
            if($('select#new-bhld').val()=='' || $('select#new-bhld-qty').val()==''){
                alert('Bạn chưa lựa chọn  trang bị hoặc số lượng')
            }else{
                let task = {name : $('select#new-bhld').val(), size : $('select#new-bhld-size').val(), qty : $('input#new-bhld-qty').val()}
                trangBiBaoHo.push(task)
                callBackShowTrangBiBaoHo()
                $('select#new-bhld').val('')
                // $('select#new-bhld-size').val('')
                $('input#new-bhld-qty').val(1)
            }
        })

        $(document).on('click','.delete', function(){
            let id = $(this).data('id')
            delete trangBiBaoHo[id]
            callBackShowTrangBiBaoHo()
        })

        //Thêm thông tin kiểm tra vỏ xe
        let voxe = []
        function callBackShowVoxe(){
            let xhtml_voxe_list = ''
            voxe.map(function(value, index){
                xhtml_voxe_list +=`<tr class="form-info">
                    <td>${value.name} ${index + 3}</td>
                    <td><input class="text-center" type="number" value="${value.status}"></td>
                    <td><input type="text"></td>
                    <td class="printer-hidden"><button class="delete" data-id="${index}" style="color: red"><i class="fas fa-minus"</i></button></td>            
                </tr>`
            })
            $('#voxe').html(xhtml_voxe_list)
        }
        callBackShowVoxe()

        $(document).on('click', 'button#add_field_vo_xe', function(){
            // if($('select#voxe-truc').val()=='' || $('input#voxe-status').val()==''){
            //     alert('Bạn chưa lựa chọn vị trí hoặc độ bền')
            // }else{
                let task = {name: 'Trục ',status: '100'}
                // {name : $('select#voxe-truc').val(), status : $('input#voxe-status').val()}
                voxe.push(task)
                callBackShowVoxe()
                // $('select#voxe-truc').val('')
                // $('input#voxe-status').val('')
            // }
        })

        $(document).on('click','.delete', function(){
            let id = $(this).data('id')
            delete voxe[id]
            callBackShowVoxe()
        })

        // Thêm thông tin trang bị theo xe
        let trangBiXe = []
        function callBackShowTrangBiXe(){
            let xhtml_xe_list = ''
            trangBiXe.map(function(value, index){
                xhtml_xe_list +=`<tr class="input-trang-bi form-info">
                    <td><label>${value.name}</label></td>
                    <td><input class="text-center" type="number" value="${value.qty}"/></td>
                    <td class="printer-hidden"><button class="delete" data-id="${index}" style="color: red"><i class="fas fa-minus"</i></button></td>            
                </tr>`
            })
            $('#trangbi_xe').html(xhtml_xe_list)
        }
        callBackShowTrangBiXe()

        $(document).on('click', 'button#add_field_xe', function(){
            if($('select#new-trangbixe').val()=='' || $('input#new-trangbixe-qty').val()==''){
                alert('Bạn chưa lựa chọn  trang bị hoặc số lượng')
            }else{
                let task = {name : $('select#new-trangbixe').val(), qty : $('input#new-trangbixe-qty').val()}
                trangBiXe.push(task)
                callBackShowTrangBiXe()
                $('select#new-trangbixe').val('')
                $('input#new-trangbixe-qty').val(1)
            }
        })

        $(document).on('click','.delete', function(){
            let id = $(this).data('id')
            delete trangBiXe[id]
            callBackShowTrangBiXe()
        })
    })
</script>
@endsection