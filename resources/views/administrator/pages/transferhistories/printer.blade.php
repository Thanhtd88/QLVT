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
            <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title printer-hidden">Biên bản bàn giao - Công ty TNHH Bình Minh Tải</h3>
                            <div class="card-tools">{{ $maxId + 1 }}</div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body style="display: block;"">    
                            <div class="row">
                                <div class="col-md-12">
                                <table style="width:100%">
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
                                        <p style="color: red; font-size: 14px">{{ $message }}</p>
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
                                                            <input type="search" class="select2" list="list-d_personal_id" name="d_personal_id" id="deliver">
                                                            <datalist id="list-d_personal_id">
                                                                @foreach ($personals as $personal)
                                                                    <option>{{ $personal->ma_nv .'-'. $personal->ho_ten }}</option>
                                                                @endforeach
                                                            </datalist>
                                                            <x-input-error :messages="$errors->get('d_personal_id')" class="mt-2" style="color: red"/>
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
                                                            <input type="search" class="select2" list="list-r_personal_id" name="r_personal_id" id="receiver">
                                                            <datalist id="list-r_personal_id">
                                                                @foreach ($personals as $personal)
                                                                    <option>{{ $personal->ma_nv .'-'. $personal->ho_ten }}</option>
                                                                @endforeach
                                                            </datalist>
                                                            <x-input-error :messages="$errors->get('r_personal_id')" class="mt-2" style="color: red"/>
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
                                                            <input type="search" class="select2" list="list-vehicle_id" name="vehicle_id" id="vehicle_giao">
                                                            <datalist id="list-vehicle_id">
                                                                @foreach ($vehicles as $vehicle)
                                                                    <option>{{ $vehicle->so_xe }}</option>
                                                                @endforeach
                                                            </datalist>
                                                            <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" style="color: red"/>
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Tải trọng:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="taitrong">
                                                        </td>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Loại:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="loaithung">
                                                        </td>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Hiệu xe:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-upper" type="text" id="nhanhieu">
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Số khung:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input class="text-upper" type="text" id="sokhung">
                                                        </td>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Số máy:</label>
                                                            </div>
                                                        </td>
                                                        <td colspan="3">
                                                            <input class="text-upper" type="text" id="somay">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>                                                        
                                                            <div class="input-group-prepend">
                                                                <label class="input-group-text">Năm sx:</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="text" id="namsx">
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
                                                                <label>Đăng ký xe</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="cavet">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Giấy chứng nhận kiểm định</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="dangkiem">
                                                                <option value="0" selected>Bản chính</option>
                                                                <option value="1">Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Giấy bảo hiểm bắt buộc TNDS</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="bhds">
                                                                <option value="0" selected>Bản chính</option>
                                                                <option value="1">Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Giấy phép đăng ký kinh doanh</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="dkkd">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Hợp đồng vận chuyển</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="hopdong_vc">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Hợp đồng lao động</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="hopdong_ld">
                                                                <option value="0">Bản chính</option>
                                                                <option value="1" selected>Bản sao</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Phù hiệu xe tải</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <select id="phuhieu">
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
                                                                <label>Bình ắc quy</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-center" type="number" id="" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Bánh dự phòng</label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input class="text-center" type="number" id="" value="1">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <label>Thiết bị định vị</label>
                                                            </div>
                                                        </td>
                                                        <td><input class="text-center" type="number" id="" value="1"></td>
                                                    </tr>
                                                    <tr class="input-trang-bi printer-hidden">
                                                        <td>
                                                            <div class="input-group-prepend">
                                                                <select id="new-trangbixe" class="form-control">
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
                                                            <select class="form-control select2" style="" id="new-bhld">
                                                                <option value="" selected="selected">--Lựa chọn--</option>
                                                                @foreach ($warehouses as $warehouse)
                                                                    <option value="{{ $warehouse->vat_tu }}">{{ $warehouse->vat_tu }}</option>
                                                                @endforeach                                    
                                                            </select>
                                                        </td>
                                                        <td><input  class="text-center" id="new-bhld-qty" type="number" value="1"></td>
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
                                                        <td><label for="ngoaiquan">Bề ngoài xe sạch sẽ, không bể, móp</label></td>
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
                                            <table style="width:100%" class="transfer-table">
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

@endsection