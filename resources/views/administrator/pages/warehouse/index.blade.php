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
            <h1>Vật tư</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('admin.warehouse.create') }}" style="margin-right: 5px" class="btn btn-primary"><i class="fas fa-plus"></i></a>
              <a href="#" style="margin-right: 5px" data-bs-toggle="modal" data-bs-target="#import-warehouse" class="btn btn-danger text-sm"><i class="fas fa-upload"></i></a>  
              <a href="" class="btn btn-success text-sm"><i class="fas fa-download"></i></a>  
              @include('administrator.pages.warehouse.import')              
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
                <h3 class="card-title">Danh sách vật tư</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="warehouse" class="table table-striped"> {{-- table-bordered --}}
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Mã vật tư</th>
                    <th>Tên vật tư</th>
                    <th class="text-center">SL nhập</th>
                    <th class="text-center">SL Xuất</th>
                    <th class="text-center">Tồn kho</th>
                    <th class="text-center">Giá mới</th>
                    <th class="text-center">Thể loại</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($warehouses as $warehouse)
                    <tr {{ !is_null($warehouse->deleted_at) ? "style=text-decoration:line-through;" : '' }}>
                      <td>{{ $loop->iteration}}</td>
                      <td>{{ $warehouse->ma_vat_tu }}</td>
                      <td>{{ $warehouse->vat_tu }}</td>
                      <td class="text-right">{{ number_format($warehouse->tong_nhap,2) }}</td>
                      <td class="text-right">{{ number_format($warehouse->tong_xuat,2) }}</td>
                      <td class="text-right">{{ number_format($warehouse->ton_kho,2) }}</td>
                      <td class="text-right">{{ number_format($warehouse->don_gia) }}</td>
                      <td class="text-center">{{ $warehouse->the_loai == 0 ? 'Phụ tùng' : 'Dụng cụ bảo hộ' }}</td>
                      <td>
                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#info-warehouse{{ $warehouse->ma_vat_tu }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a> --}}
                        <div class="btn-icon btn">
                          <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                              <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                                @if ($warehouse->trashed())
                                  <form action="{{ route('admin.warehouse.restore', ['id' => $warehouse->id]) }}" method="POST">
                                      @csrf
                                      <div class="dropdown-divider"></div>
                                      <button type="submit" class="dropdown-item">
                                        <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                      </button>
                                  </form>
                                  <div class="dropdown-divider"></div>
                                  <a data-bs-toggle="modal" data-bs-target="#notification{{ $warehouse->id }}" type="submit" class="dropdown-item">
                                    <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                  </a>
                                @else
                                  <div class="dropdown-divider"></div>
                                  <a href="{{ route('admin.warehouse.edit', ['warehouse' => $warehouse->ma_vat_tu]) }}" type="submit" class="dropdown-item">
                                    <i class="far fa-edit mr-2"></i> Chỉnh sửa
                                  </a>
                                  <div class="dropdown-divider"></div>
                                  <a data-bs-toggle="modal" data-bs-target="#notification{{ $warehouse->id }}" type="submit" class="dropdown-item">
                                    <i class="fas fa-trash mr-2"></i> Xóa
                                  </a>
                                @endif
                              </div>
                            </li>
                          </ul>
                        </div>

                        <!-- popup detail -->
                        {{-- @include('administrator.pages.warehouse.info') --}}
                        
                        <!-- notify -->
                        <div class="modal fade" id="notification{{ $warehouse->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
                                <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                              </div>
                              <div class="modal-body">
                                Bạn muốn xóa {{ $warehouse->vat_tu}} {{ !is_null($warehouse->deleted_at) ? 'khỏi hệ thống' : '' }}?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                                @if (is_null($warehouse->deleted_at))
                                  <form action="{{ route('admin.warehouse.destroy', ['warehouse' => $warehouse->id]) }}" method="post">
                                    @csrf
                                    @method('delete')                           
                                    <a href="{{ route('admin.warehouse.destroy', ['warehouse' => $warehouse->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                  </form>
                                @else
                                  <form action="{{ route('admin.warehouse.force.delete', ['id' => $warehouse->id]) }}" method="POST">
                                    @csrf
                                    <a href="{{ route('admin.warehouse.force.delete', ['id' => $warehouse->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
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
  Vật tư
@endsection

@section('js-custom')
  <script>
    $(function () {
      $('.toast').toast('show');

      $("#warehouse").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>
@endsection