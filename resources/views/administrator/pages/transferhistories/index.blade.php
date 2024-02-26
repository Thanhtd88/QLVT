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
          <h1>Lịch sử bàn giao xe</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route('admin.transfer.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
              <h3 class="card-title">Danh sách bàn giao</h3>
              <div class="card-tools">
                {{-- <form action="{{ route('admin.transfer.index') }}" method="get">
                  <div class="input-group input-group-sm" style="width: 250px;">                  
                    <input type="search" name="keyword" class="form-control float-right" placeholder="Số xe / Tài xế" value="{{ request()->get('keyword') }}" autocomplete="off">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-info bg-white"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form> --}}
              </div>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
              <table id="transfer" class="table table-striped center table-sm">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th>Loại BB</th>
                  <th>Số BB</th>
                  <th>Ngày bàn giao</th>
                  <th>Lái xe</th>
                  <th>Số xe</th>
                  <th>Tình trạng</th>
                  <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($transfers as $transfer)
                  <tr {{ !is_null($transfer->deleted_at) ? "style=text-decoration:line-through;" : '' }}>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $transfer->loai_bien_ban == 0 ? 'Bàn giao' : 'Thu hồi' }}</td>
                    <td>{{ $transfer->so_bien_ban }}</td>
                    <td>{{ date('d-m-Y', strtotime($transfer->ngay_ban_giao)) }}</td>
                    <td>{{ $transfer->tai_xe }}</td>
                    <td>{{ $transfer->so_xe }}</td>
                    <td>{{ $transfer->tinh_trang_xe }}</td>
                    <td>
                      {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#info-transfer{{ $transfer->ma_nv }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a> --}}
                      <div class="btn-icon btn">
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-item dropdown">
                            <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                              @if ($transfer->trashed())
                                <form action="{{ route('admin.transfer.restore', ['id' => $transfer->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                      <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $transfer->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                </a>
                              @else
                                <a href="{{ route('admin.transfer.printer') }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-print mr-2"></i> In biên bản
                                </a> 
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $transfer->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-trash mr-2"></i> Xóa
                                </a>
                              @endif
                            </div>
                          </li>
                        </ul>
                      </div>

                      <!-- popup detail -->
                      {{-- @include('administrator.pages.transfer.info') --}}
                      
                      <!-- notify -->
                      <div class="modal fade" id="notification{{ $transfer->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
                              <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                            </div>
                            <div class="modal-body">
                              Bạn muốn xóa biên bản bàn giao số hiệu {{ $transfer->so_bien_ban}} {{ !is_null($transfer->deleted_at) ? 'khỏi hệ thống' : '' }}?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                              @if (is_null($transfer->deleted_at))
                                <form action="{{ route('admin.transfer.destroy', ['transfer' => $transfer->id]) }}" method="post">
                                  @csrf
                                  @method('delete')                           
                                  <a href="{{ route('admin.transfer.destroy', ['transfer' => $transfer->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                </form>
                              @else
                                <form action="{{ route('admin.transfer.force.delete', ['id' => $transfer->id]) }}" method="POST">
                                  @csrf
                                  <a href="{{ route('admin.transfer.force.delete', ['id' => $transfer->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
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
    Bàn giao xe
@endsection

@section('js-custom')
<script>
  $(function () {
    $('.toast').toast('show');

    new DataTable('#transfer', {
      responsive: true
    });    
  });
</script>
@endsection