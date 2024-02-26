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
          <h1>Lịch sử nhập hàng</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route('admin.stock-in.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
            <a href="" class="btn btn-success text-sm" style="margin-left: 5px"><i class="fas fa-download"></i></a>              
          </ol>
        </div>
      </div>      
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách hàng nhập</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="stock_in" class="table table-striped"> {{-- table-bordered --}}
                <thead>
                <tr>
                  <th>#</th>
                  <th>Ngày nhập</th>
                  <th>Vật tư</th>
                  <th>Số lượng</th>
                  <th>Đơn giá</th>
                  <th>Nhà cung cấp</th>
                  <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($stock_ins as $stock_in)
                  <tr {{ !is_null($stock_in->deleted_at) ? "style=text-decoration:line-through;" : '' }}>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ date("d-m-Y", strtotime($stock_in->ngay_nhap_kho)) }}</td>
                    <td>{{ !is_null($stock_in->warehouse_id) ? $stock_in->warehouse->vat_tu : '' }}</td>
                    <td>{{ $stock_in->so_luong_nhap }}</td>
                    <td>{{ number_format($stock_in->don_gia_nhap) }}</td>
                    <td>{{ !is_null($stock_in->supplier_id ) ? $stock_in->supplier->ten_ncc : '' }}</td>
                    <td>
                      {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#info-stock_in{{ $stock_in->id }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a> --}}
                      <div class="btn-icon btn">
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-item dropdown">
                            <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                              @if ($stock_in->trashed())
                                <form action="{{ route('admin.stock-in.restore', ['id' => $stock_in->id]) }}" method="POST">
                                    @csrf
                                    <div class="dropdown-divider"></div>
                                    <button type="submit" class="dropdown-item">
                                      <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $stock_in->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                </a>
                              @else
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.stock-in.edit', ['stock_in' => $stock_in->id]) }}" type="submit" class="dropdown-item">
                                  <i class="far fa-edit mr-2"></i> Chỉnh sửa
                                </a>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $stock_in->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-trash mr-2"></i> Xóa
                                </a>
                              @endif
                            </div>
                          </li>
                        </ul>
                      </div>

                      <!-- popup detail -->
                      {{-- @include('administrator.pages.stockin.info') --}}
                      
                      <!-- notify -->
                      <div class="modal fade" id="notification{{ $stock_in->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
                              <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                            </div>
                            <div class="modal-body">
                              Bạn muốn xóa thông tin nhập hàng {{ !is_null($stock_in->warehouse_id) ? $stock_in->warehouse->vat_tu : '' }} ngày {{ date("d-m-Y", strtotime($stock_in->ngay_nhap_kho)) }} {{ !is_null($stock_in->deleted_at) ? 'khỏi hệ thống' : '' }}?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                              @if (is_null($stock_in->deleted_at))
                                <form action="{{ route('admin.stock-in.destroy', ['stock_in' => $stock_in->id]) }}" method="post">
                                  @csrf
                                  @method('delete')                           
                                  <a href="{{ route('admin.stock-in.destroy', ['stock_in' => $stock_in->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                </form>
                              @else
                                <form action="{{ route('admin.stock-in.force.delete', ['id' => $stock_in->id]) }}" method="POST">
                                  @csrf
                                  <a href="{{ route('admin.stock-in.force.delete', ['id' => $stock_in->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                </form>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.notify -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection


@section('title')
    Nhập kho
@endsection

@section('js-custom')
<script>
  $(document).ready(function(){
    $('.toast').toast('show');
  });
  $(function () {
    $("#stock_in").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endsection