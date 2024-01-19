{{-- @extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nhân sự - Thông tin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.personal.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> --}}

<form role="form" method="POST">
    <div class="modal fade" id="info-personal{{ $personal->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin cá nhân</h5>
                <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 two-column">                            
                    <div class="col-md-2">
                        <div class="card-body body-shadow">
                            @if (!is_null($personal->image_url))
                                <img src="{{ asset('image'). '/'. $personal->image_url }}" alt="" style="width:100%">
                            @else
                                <p>Chưa có ảnh</p>      
                            @endif   
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="card-body body-shadow p-0 border-content-none">
                            <table class="table">
                                <tr>
                                    <th style="width: 150px">Mã nhân viên</th>
                                    <td colspan="9">{{ $personal->ma_nv }}</td>
                                </tr>
                                <tr>
                                    <th>Họ tên</th>
                                    <td colspan="2">{{ $personal->ho_ten }}</td>
                                    <th>Ngày sinh</th>
                                    <td colspan="7">{{ date("d-m-Y", strtotime($personal->ngay_sinh)) }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td colspan="9">{{ $personal->sdt }}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td colspan="9">{{ $personal->dia_chi }}</td>
                                </tr>
                                <tr>
                                    <th>CCCD/CMND</th>
                                    <td colspan="2">{{ $personal->cccd }}</td>
                                    <th>Ngày cấp</th>
                                    <td colspan="2">{{ date("d-m-Y", strtotime($personal->ngay_cap_cccd)) }}</td>
                                    <th>Nơi cấp</th>
                                    <td colspan="5">{{ $personal->noi_cap_cccd }}</td>
                                </tr>
                                @if ($personal->department_id === 7)
                                    <tr>
                                        <th rowspan="2">GPLX</th>
                                        <td colspan="2" rowspan="2">{{ $personal->gplx }}</td>
                                        <th>Ngày cấp</th>
                                        <td colspan="2">{{ date("d-m-Y", strtotime($personal->ngay_cap_gplx)) }}</td>
                                        <th>Nơi cấp</th>
                                        <td>{{ $personal->noi_cap_gplx }}</td>
                                    </tr> 
                                    <tr>
                                        <th>Hạng</th>
                                        <td colspan="2">{{ $personal->hang_gplx }}</td>
                                        <th>Hiệu lực</th>
                                        <td>{{ date("d-m-Y", strtotime($personal->hieu_luc_gplx)) }}</td>
                                    </tr>   
                                    <tr>
                                        <th>Dự án</th>
                                        <td colspan="9">{{ $personal->project_id ? $personal->project->du_an : null }}</td>
                                    </tr>                                      
                                @endif     
                                <tr>
                                    <th>Phòng ban</th>
                                    <td colspan="2">{{ $personal->department_id ? $personal->department->phong_ban : null }}</td>
                                    <th>Đơn vị</th>
                                    <td colspan="9">{{ $personal->unit->don_vi }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày vào làm</th>
                                    <td colspan="9">{{ date("d-m-Y", strtotime($personal->ngay_vao)) }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td colspan="9">{{ $personal->trang_thai == 0 ? 'Đang làm' : 'Nghỉ việc' }}</td>
                                </tr>
                                @if ($personal->trang_thai !== 0)
                                    <tr>
                                        <th>Ngày nghỉ</th>
                                        <td colspan="9">{{ date("d-m-Y", strtotime($personal->ngay_nghi)) }}</td>
                                    </tr>
                                @endif                                        
                                <tr>
                                    <th>BHXH</th>
                                    <td colspan="9">{{ $personal->bhxh == 'on' ? "Đã đóng" : "Chưa đóng" }}</td>
                                </tr>                                   
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Đóng</button>
                <a href="{{ route('admin.personal.edit', ['personal' => $personal->ma_nv]) }}" type="submit" class="btn btn-primary"><i style="margin: 0 5px" class="far fa-edit"></i>Sửa</a>
            </div>
        </div>
    </div>
</div>
</form>

    {{-- <section class="info">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin cá nhân</h3>
                        </div>                    
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST">
                            <div class="col-md-12 two-column">                            
                                <div class="col-md-2">
                                    <div class="card-body body-shadow">
                                        <img src="{{ asset('image'). '/'. $personal->image_url }}" alt="" style="width:100%">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="card-body body-shadow p-0">
                                        <table class="table">
                                            <tr>
                                                <th style="width: 150px">Mã nhân viên</th>
                                                <td colspan="9">{{ $personal->manv }}</td>
                                            </tr>
                                            <tr>
                                                <th>Họ tên</th>
                                                <td colspan="2">{{ $personal->hoten }}</td>
                                                <th>Ngày sinh</th>
                                                <td colspan="7">{{ date("d-m-Y", strtotime($personal->ngaysinh)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Số điện thoại</th>
                                                <td colspan="9">{{ $personal->sdt }}</td>
                                            </tr>
                                            <tr>
                                                <th>Địa chỉ</th>
                                                <td colspan="9">{{ $personal->diachi }}</td>
                                            </tr>
                                            <tr>
                                                <th>CCCD/CMND</th>
                                                <td colspan="2">{{ $personal->cccd }}</td>
                                                <th>Ngày cấp</th>
                                                <td colspan="2">{{ date("d-m-Y", strtotime($personal->ngaycap_cccd)) }}</td>
                                                <th>Nơi cấp</th>
                                                <td colspan="5">{{ $personal->noicap_cccd }}</td>
                                            </tr>
                                            @if ($personal->phongban_id === 7)
                                                <tr>
                                                    <th rowspan="2">GPLX</th>
                                                    <td colspan="2" rowspan="2">{{ $personal->gplx }}</td>
                                                    <th>Ngày cấp</th>
                                                    <td colspan="2">{{ date("d-m-Y", strtotime($personal->ngaycap_gplx)) }}</td>
                                                    <th>Nơi cấp</th>
                                                    <td>{{ $personal->noicap_gplx }}</td>
                                                </tr> 
                                                <tr>
                                                    <th>Hạng</th>
                                                    <td colspan="2">{{ $personal->hang_gplx }}</td>
                                                    <th>Hiệu lực</th>
                                                    <td>{{ date("d-m-Y", strtotime($personal->hieuluc_gplx)) }}</td>
                                                </tr>   
                                                <tr>
                                                    <th>Dự án</th>
                                                    <td colspan="9">{{ $personal->project->duan }}</td>
                                                </tr>                                      
                                            @endif     
                                            <tr>
                                                <th>Phòng ban</th>
                                                <td colspan="2">{{ $personal->department->phongban }}</td>
                                                <th>Đơn vị</th>
                                                <td colspan="9">{{ $personal->unit->donvi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Ngày vào làm</th>
                                                <td colspan="9">{{ date("d-m-Y", strtotime($personal->ngayvao)) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Trạng thái</th>
                                                <td colspan="9">{{ $personal->trangthai == 0 ? 'Đang làm' : 'Nghỉ việc' }}</td>
                                            </tr>
                                            @if ($personal->trangthai !== 0)
                                                <tr>
                                                    <th>Ngày nghỉ</th>
                                                    <td colspan="9">{{ date("d-m-Y", strtotime($personal->ngaynghi)) }}</td>
                                                </tr>
                                            @endif                                        
                                            <tr>
                                                <th>BHXH</th>
                                                <td colspan="9">{{ $personal->bhxh == 'on' ? "Đã đóng" : "Chưa đóng" }}</td>
                                            </tr>                                   
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
        
                            <div class="card-footer">
                                <a href="{{ route('admin.personal.edit', ['personal' => $personal->manv]) }}" type="submit" class="btn btn-primary"><i style="margin: 0 5px" class="far fa-edit"></i>Sửa</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    </section>  --}}
{{-- </div>
@endsection

@section('title')
    Nhân sự
@endsection --}}