@extends('administrator.layout.master')

@section('content')
  @if (session('msg'))
    @include('administrator.pages.notification')
  @endif
  @error('import_file')
    <div class="position-fixed top-1 p-3" style="z-index: 9; right: 30%">
      <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-center">
          {{ $message }}
        </div>
      </div>
    </div>
  @enderror
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Phương tiện</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <a href="{{ route('admin.vehicle.create') }}" style="margin-right: 5px" class="btn btn-primary"><i class="fas fa-plus"></i></a>  
              <a href="#" style="margin-right: 5px" data-bs-toggle="modal" data-bs-target="#import-vehicle" class="btn btn-danger text-sm"><i class="fas fa-upload"></i></a>  
              {{-- <a href="{{ route('admin.vehicle.export') }}" class="btn btn-success text-sm"><i class="fas fa-download"></i></a>   --}}
              <button type="submit" class="btn btn-success text-sm" name="download"><i class="fas fa-download"></i></button>
              @include('administrator.pages.vehicle.import')            
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <form action="{{ route('admin.vehicle.index') }}" method="get">
              <div class="card collapsed-card">            
                <div class="card-header">
                    <h3 class="card-title">
                      Lọc giá trị
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
              
                <div class="card-body">
                  <div class="row">
                    <div class="box1 col-md-3">
                      <div class="form-floating mb-3">
                        <input value="{{ request()->get('loai_thung') }}" type="text" class="form-control" id="loai_thung" placeholder="" name="loai_thung">
                        <label for="loai_thung">Loại thùng</label>
                      </div>
                    </div>
                    <div class="box1 col-md-3">
                      <div class="form-floating mb-3">
                        <input value="{{ request()->get('nhan_hieu') }}" type="text" class="form-control" id="nhan_hieu" placeholder="" name="nhan_hieu">
                        <label for="nhan_hieu">Nhãn hiệu</label>
                      </div>
                    </div>
                    <div class="box1 col-md-3">
                      <div class="form-floating">
                        <select class="form-select" id="tai_trong" aria-label="Floating label select example" name="tai_trong">
                          <option value="">Tất cả</option>
                          <option {{ request()->get('tai_trong') === '1' ? 'selected' : '' }} value="1">Dưới 3 tấn</option>
                          <option {{ request()->get('tai_trong') === '2' ? 'selected' : '' }} value="2">Từ 3 tấn đến 10 tấn</option>
                          <option {{ request()->get('tai_trong') === '3' ? 'selected' : '' }} value="3">Trên 10 tấn</option>
                        </select>
                        <label for="tai_trong">Tải trọng</label>
                      </div>
                    </div>
                    <div class="box1 col-md-3">
                      <div class="form-floating">
                        <select class="form-select" id="trang_thai" aria-label="Floating label select example" name="trang_thai">
                          <option value="">Tất cả</option>
                          <option {{ request()->get('trang_thai') == 'Hoạt động' ? 'selected' : '' }}>Hoạt động</option>
                          <option {{ request()->get('trang_thai') == 'Sửa chữa' ? 'selected' : '' }}>Sửa chữa</option>
                          <option {{ request()->get('trang_thai') == 'Tạm dừng' ? 'selected' : '' }}>Tạm dừng</option>
                          <option {{ request()->get('trang_thai') == 'Đã bán' ? 'selected' : ''  }}>Đã bán</option>
                        </select>
                        <label for="trang_thai">Trạng thái</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer btn-group-sm">
                  <button type="submit" class="btn btn-primary float-right"><i class="fas fa-filter"></i> Lọc</button>
                  <a href="{{ route('admin.vehicle.index') }}" class="btn btn-danger float-right" style="margin: 0 5px"><i class="fas fa-times"></i> Hủy lọc</a>
                </div>
              </div>
            </form>

            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Danh sách phương tiện</h3>
              </div>
              <div class="card-body">
                <table id="vehicle" class="table table-sm table-striped nowrap table-hover dataTable dtr-inline collapsed center">
                      <thead>
                          <tr>
                              <th></th>
                              <th>Số xe</th>
                              <th>Tài xế</th>
                              <th>Loại thùng</th>
                              <th>Tải trọng</th>
                              <th>Nhãn hiệu</th>
                              <th class="text-center">Số km mới</th>
                              <th class="text-center">Trạng thái</th>
                              <th class="text-center">Thao tác</th>
                          </tr>
                      </thead>
                      <tbody>
                        @php
                        
                        @endphp
                        @foreach ($vehicles as $vehicle)
                        <tr {{ (!is_null($vehicle->deleted_at) && Auth::user()->role == 1) ? "style=text-decoration:line-through;" : '' }}>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $vehicle->so_xe }}</td>
                            <td>{{ !is_null($vehicle->personal_id) ? $vehicle->personal->ho_ten : '' }}</td>
                            <td>{{ $vehicle->loai_thung }}</td>
                            <td>{{ $vehicle->loai_thung === 'Đầu kéo' ? number_format($vehicle->khoi_luong_keo_theo,0) : number_format($vehicle->khoi_luong_hang_hoa,0)}} kg</td>
                            <td style="text-transform: uppercase">{{ $vehicle->nhan_hieu }}</td>
                            <td class="text-center">{{ $vehicle->odo }}</td>
                            <td class="text-center">
                              <div class="btn-icon btn">
                                  <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                      <a class="btn btn-action" data-toggle="dropdown" href="#">
                                        <i>{{ $vehicle->trang_thai }}</i>
                                      </a>
                                      @if (is_null($vehicle->ngay_ban))
                                      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <form action="{{  route('admin.vehicle.hoatdong', ['id' => $vehicle->id]) }}" method="POST">
                                          @csrf
                                          <button  type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-play mr-2"></i> Hoạt động
                                          </button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{  route('admin.vehicle.suachua', ['id' => $vehicle->id]) }}" method="POST">
                                          @csrf
                                          <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-screwdriver mr-2"></i> Sửa chữa
                                          </button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{  route('admin.vehicle.tamdung', ['id' => $vehicle->id]) }}" method="POST">
                                          @csrf
                                          <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-pause mr-2"></i> Tạm dừng
                                          </button>      
                                        </form>                               
                                      </div>
                                      @endif
                                    </li>
                                  </ul> 
                              </div>
                            </td>
                            <td class="text-center">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#info-vehicle{{ $vehicle->id }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a>
                              <div class="btn-icon btn">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item dropdown">
                                    <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                                      @if ($vehicle->trashed())
                                        <form action="{{ route('admin.vehicle.restore', ['id' => $vehicle->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                              <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                            </button>
                                        </form>
                                        <div class="dropdown-divider"></div>
                                        <a data-bs-toggle="modal" data-bs-target="#notification{{ $vehicle->id }}" type="submit" class="dropdown-item">
                                          <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                        </a>
                                      @else
                                        <a href="{{ route('admin.vehicle.edit', ['vehicle' => $vehicle->so_xe]) }}" type="submit" class="dropdown-item">
                                          <i class="far fa-edit mr-2"></i> Chỉnh sửa
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a data-bs-toggle="modal" data-bs-target="#notification{{ $vehicle->id }}" type="submit" class="dropdown-item">
                                          <i class="fas fa-trash mr-2"></i> Xóa
                                        </a>
                                      @endif
                                    </div>
                                  </li>
                                </ul>
                              </div>
        
                              <!-- model-->
                              @include('administrator.pages.vehicle.info')
                              
                              <!-- toast -->
                              <div class="modal fade" id="notification{{ $vehicle->id }}" tabindex="-1" aria-labelledby="create-account" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="create-account">Thông tin</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      Bạn muốn xóa phương tiện {{ $vehicle->so_xe }} {{ !is_null($vehicle->deleted_at) ? 'khỏi hệ thống' : '' }}?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                                      @if (is_null($vehicle->deleted_at))
                                        <form action="{{ route('admin.vehicle.destroy', ['vehicle' => $vehicle->id]) }}" method="post">
                                          @csrf
                                          @method('delete')                           
                                          <a href="{{ route('admin.vehicle.destroy', ['vehicle' => $vehicle->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                        </form>
                                      @else
                                        <form action="{{ route('admin.vehicle.force.delete', ['id' => $vehicle->id]) }}" method="POST">
                                          @csrf
                                          <a href="{{ route('admin.vehicle.force.delete', ['id' => $vehicle->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
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
              {{-- <div class="card-footer">
                {{ $vehicles->links() }}
              </div> --}}
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
  Phương tiện
@endsection

@section('js-custom')
  <script>
    $(function () {
      $('.toast').toast('show');

      new DataTable('#vehicle', {
        responsive: true
      });
    });
  </script>
@endsection