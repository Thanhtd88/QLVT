@extends('administrator.layout.master')

@section('content')

<div class="content-wrapper">
@if (session('msg'))
  <div class="position-fixed top-0 right-0 p-3" style="z-index: 9; right: 35%; top: 10;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="0">
      <div class="toast-body alert-success">
        {{ session('msg') }}
      </div>
    </div>
  </div>
@endif
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tài khoản</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.account.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a></li>              
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
                        <h3 class="card-title">Danh sách tài khoản</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="account" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Họ tên</th>
                                    <th>Ngày tạo</th>
                                    <th>Phân Quyền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($users as $user)
                              <tr {{ (!is_null($user->deleted_at) && Auth::user()->role == 1) ? "style=text-decoration:line-through;" : '' }}>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $user->email }}</td>
                                  <td>{{ $user->name }}</td>
                                  <td>{{ $user->created_at }}</td>
                                  <td>{{ $user->role == 1 ? 'Admin' : 'User' }}</td>
                                  <td>
                                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#info-user{{ $user->id }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a> --}}
                                    <div class="btn-icon btn">
                                      <ul class="navbar-nav ml-auto">
                                        <li class="nav-item dropdown">
                                          <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                                          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                                            @if ($user->trashed())
                                              <form action="{{ route('admin.account.restore', ['id' => $user->id]) }}" method="POST">
                                                  @csrf
                                                  <div class="dropdown-divider"></div>
                                                  <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                                  </button>
                                              </form>
                                              <div class="dropdown-divider"></div>
                                              <a data-bs-toggle="modal" data-bs-target="#notification{{ $user->id }}" type="submit" class="dropdown-item">
                                                <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                              </a>
                                            @else
                                              {{-- <div class="dropdown-divider"></div>
                                              <a href="{{ route('admin.account.edit', ['account' => $user->id]) }}" type="submit" class="dropdown-item">
                                                <i class="far fa-edit mr-2"></i> Chỉnh sửa
                                              </a> --}}
                                              <div class="dropdown-divider"></div>
                                              <a data-bs-toggle="modal" data-bs-target="#notification{{ $user->id }}" type="submit" class="dropdown-item">
                                                <i class="fas fa-trash mr-2"></i> Xóa
                                              </a>
                                            @endif
                                          </div>
                                        </li>
                                      </ul>
                                    </div>
              
                                    <!-- popup detail -->
                                    {{-- @include('administrator.pages.user.info') --}}
                                    
                                    <!-- notify -->
                                    <div class="modal fade" id="notification{{ $user->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
                                            <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                                          </div>
                                          <div class="modal-body">
                                            Bạn muốn xóa tài khoản {{ $user->email }} {{ !is_null($user->deleted_at) ? 'khỏi hệ thống' : '' }}?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                                            @if (is_null($user->deleted_at))
                                              <form action="{{ route('admin.account.destroy', ['account' => $user->id]) }}" method="post">
                                                @csrf
                                                @method('delete')                           
                                                <a href="{{ route('admin.account.destroy', ['account' => $user->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                              </form>
                                            @else
                                              <form action="{{ route('admin.account.force.delete', ['id' => $user->id]) }}" method="POST">
                                                @csrf
                                                <a href="{{ route('admin.account.force.delete', ['id' => $user->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
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
                  <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('title')
    Tài khoản
@endsection

@section('js-custom')
<script>
  $(document).ready(function(){
    $('.toast').toast('show');
  });
  $(function () {
    $("#account").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
@endsection