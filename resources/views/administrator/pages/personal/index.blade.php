@extends('administrator.layout.master')

@section('content')
@if (session('msg'))
  @include('administrator.pages.notification')
@endif
@error('import_file') 
  <div class="position-fixed top-0 right-0 p-3" style="z-index: 9; right: 35%; top: 10;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="0">
      <div class="toast-body alert-warning">
        {{ $message }}
      </div>
    </div>
  </div>
@enderror
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Nhân sự</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">   
            <a href="{{ route('admin.personal.create') }}" style="margin-right: 5px" class="btn btn-primary text-sm"><i class="fas fa-plus"></i></a>
            <a href="#" style="margin-right: 5px" data-bs-toggle="modal" data-bs-target="#import-personal" class="btn btn-danger text-sm"><i class="fas fa-upload"></i></a>  
            <a href="{{ route('admin.personal.export') }}" class="btn btn-success text-sm"><i class="fas fa-download"></i></a>  
            @include('administrator.pages.personal.import')  
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
              <h3 class="card-title">Danh sách nhân viên</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="personal" class="table table-striped"> {{-- table-bordered --}}
                <thead>
                <tr>
                  <th>#</th>
                  <th>Mã nhân viên</th>
                  <th>Tên nhân viên</th>
                  <th>Số điện thoại</th>
                  <th>Số xe phụ trách</th>
                  <th>Dự án</th>
                  <th>Phòng ban</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($personals as $personal)
                  <tr {{ !is_null($personal->deleted_at) ? "style=text-decoration:line-through;" : '' }}>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $personal->ma_nv }}</td>
                    <td>{{ $personal->ho_ten }}</td>
                    <td>{{ $personal->sdt }}</td>
                    <td>{{ !is_null($personal->vehicle_id) ? $personal->vehicle->so_xe : '' }}</td>
                    <td>{{ !is_null($personal->project_id) ? $personal->project->du_an : '' }}</td>
                    <td>{{ !is_null($personal->department_id) ? $personal->department->phong_ban : '' }}</td>
                    <td>{{ $personal->trang_thai === 0 ? 'Đang làm' : 'Nghỉ việc' }}</td>
                    <td>
                      <a href="#" data-bs-toggle="modal" data-bs-target="#info-personal{{ $personal->id }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a>
                      <div class="btn-icon btn">
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-item dropdown">
                            <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                              @if ($personal->trashed())
                                <form action="{{ route('admin.personal.restore', ['id' => $personal->id]) }}" method="POST">
                                    @csrf
                                    <div class="dropdown-divider"></div>
                                    <button type="submit" class="dropdown-item">
                                      <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $personal->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                </a>
                              @else
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('admin.personal.edit', ['personal' => $personal->ma_nv]) }}" type="submit" class="dropdown-item">
                                  <i class="far fa-edit mr-2"></i> Chỉnh sửa
                                </a>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $personal->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-trash mr-2"></i> Xóa
                                </a>
                              @endif
                            </div>
                          </li>
                        </ul>
                      </div>

                      <!-- popup detail -->
                      @include('administrator.pages.personal.info')
                      
                      <!-- notify -->
                      <div class="modal fade" id="notification{{ $personal->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
                              <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                            </div>
                            <div class="modal-body">
                              Bạn muốn xóa nhân viên {{ $personal->ma_nv.'-'.$personal->ho_ten}} {{ !is_null($personal->deleted_at) ? 'khỏi hệ thống' : '' }}?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                              @if (is_null($personal->deleted_at))
                                <form action="{{ route('admin.personal.destroy', ['personal' => $personal->id]) }}" method="post">
                                  @csrf
                                  @method('delete')                           
                                  <a href="{{ route('admin.personal.destroy', ['personal' => $personal->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                </form>
                              @else
                                <form action="{{ route('admin.personal.force.delete', ['id' => $personal->id]) }}" method="POST">
                                  @csrf
                                  <a href="{{ route('admin.personal.force.delete', ['id' => $personal->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
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
    Nhân sự
@endsection

@section('js-custom')
<script>
  $(function () {
    $('.toast').toast('show');

    $("#personal").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

</script>
@endsection