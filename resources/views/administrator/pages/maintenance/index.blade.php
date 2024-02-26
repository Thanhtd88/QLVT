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
          <h1>Bảo dưỡng - sửa chữa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <a href="{{ route('admin.maintenance.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
          <form action="{{ route('admin.maintenance.index') }}" method="get">
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
                    <div class="form-group">
                      <span>Ngày</span>
                      <div class="input-group input-group-sm">
                        <input class="form-control" type="search" name="khoang_thoi_gian" value="{{ request()->get('khoang_thoi_gian') }}" autocomplete="off"/>
                      </div>
                    </div>
                  </div>
                  <div class="box1 col-md-3">
                    <span>Số xe</span>
                    <div class="form-group mb-3 input-group-sm">
                      <input type="search" class="form-control" list="list-vehicle" name="so_xe" value="{{ request()->get('so_xe') }}" >
                      <datalist id="list-vehicle">
                        @foreach ($vehicles as $vehicle)
                          <option>{{ $vehicle->so_xe }}</option>
                        @endforeach
                      </datalist>
                    </div>
                  </div>
                  <div class="box1 col-md-3">
                    <span>Vật tư thay thế</span>
                    <div class="form-group mb-3 input-group-sm">
                      <input type="search" class="form-control" list="list-vat-tu" name="vat_tu" value="{{ request()->get('vat_tu') }}">
                      <datalist id="list-vat-tu">
                        @foreach ($warehouses as $warehouse)
                          <option>{{ $warehouse->vat_tu }}</option>
                        @endforeach
                      </datalist>
                    </div> 
                  </div>
                  <div class="box1 col-md-3">
                    <span>Loại sửa chữa</span>
                    <div class="input-group input-group-sm">
                      <select name="loai" id="" class="form-select">
                        <option value="">Tất cả</option>
                        <option {{ request()->get('loai') === '0' ? 'selected' : '' }} value="0">Bảo dưỡng - sửa chửa</option>
                        <option {{ request()->get('loai') === '1' ? 'selected' : '' }} value="1">Bảo hiểm</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>              
              <div class="card-footer btn-group-sm">
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-filter"></i> Lọc</button>
                <a href="{{ route('admin.maintenance.index') }}" class="btn btn-danger float-right" style="margin: 0 5px"><i class="fas fa-times"></i> Hủy lọc</a>
              </div>
            </div>
          </form>

          <div class="form-group">
            {{-- <label for="input-datalist">Timezone</label> --}}
            
        </div>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách bảo dưỡng - sửa chữa</h3>
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
              <table id="maintenance" class="table table-striped nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Ngày</th>
                  <th>Số xe</th>
                  <th>Km</th>
                  <th>Vật tư thay thế</th>
                  <th>Số lượng</th>
                  <th>Đơn giá</th>
                  <th>Thành tiền</th>
                  <th>Loại</th>
                  <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($maintenances as $maintenance)
                  <tr {{ !is_null($maintenance->deleted_at) ? "style=text-decoration:line-through;" : '' }}>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($maintenance->ngay_thuc_hien)) }}</td>
                    <td>{{ !is_null($maintenance->vehicle_id) ? $maintenance->vehicle->so_xe : '' }}</td>
                    <td>{{ $maintenance->odo }}</td>
                    <td>{{ !is_null($maintenance->warehouse_id) ? $maintenance->warehouse->vat_tu : '' }}</td>
                    <td>{{ $maintenance->so_luong }}</td>
                    <td>{{ number_format($maintenance->don_gia) }}</td>
                    <td>{{ number_format($maintenance->thanh_tien) }}</td>
                    <td>{{ $maintenance->loai == 0 ? 'Bảo dưỡng - sửa chửa' : 'Bảo hiểm' }}</td>
                    <td>
                      {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#info-maintenance{{ $maintenance->ma_nv }}" type="submit" class="btn btn-info btn-icon"><i class="fas fa-eye"></i></a> --}}
                      <div class="btn-icon btn">
                        <ul class="navbar-nav ml-auto">
                          <li class="nav-item dropdown">
                            <a class="btn btn-primary btn-action" data-toggle="dropdown" href="#"><i class="fas fa-th-large"></i></a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
                              @if ($maintenance->trashed())
                                <form action="{{ route('admin.maintenance.restore', ['id' => $maintenance->id]) }}" method="POST">
                                    @csrf
                                    <div class="dropdown-divider"></div>
                                    <button type="submit" class="dropdown-item">
                                      <i class="fas fa-trash-restore mr-2"></i> Khôi phục
                                    </button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $maintenance->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-ban"></i> Xóa vĩnh viễn
                                </a>
                              @else
                                <a href="{{ route('admin.maintenance.edit', ['maintenance' => $maintenance->id]) }}" type="submit" class="dropdown-item">
                                  <i class="far fa-edit mr-2"></i> Chỉnh sửa
                                </a>
                                <div class="dropdown-divider"></div>
                                <a data-bs-toggle="modal" data-bs-target="#notification{{ $maintenance->id }}" type="submit" class="dropdown-item">
                                  <i class="fas fa-trash mr-2"></i> Xóa
                                </a>
                              @endif
                            </div>
                          </li>
                        </ul>
                      </div>

                      <!-- popup detail -->
                      {{-- @include('administrator.pages.maintenance.info') --}}
                      
                      <!-- notify -->
                      <div class="modal fade" id="notification{{ $maintenance->id }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
                              <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
                            </div>
                            <div class="modal-body">
                              Bạn muốn xóa thông tin sửa chữa xe {{ $maintenance->vehicle->so_xe }} {{ !is_null($maintenance->deleted_at) ? 'khỏi hệ thống' : '' }}?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button> 
                              @if (is_null($maintenance->deleted_at))
                                <form action="{{ route('admin.maintenance.destroy', ['maintenance' => $maintenance->id]) }}" method="post">
                                  @csrf
                                  @method('delete')                           
                                  <a href="{{ route('admin.maintenance.destroy', ['maintenance' => $maintenance->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
                                </form>
                              @else
                                <form action="{{ route('admin.maintenance.force.delete', ['id' => $maintenance->id]) }}" method="POST">
                                  @csrf
                                  <a href="{{ route('admin.maintenance.force.delete', ['id' => $maintenance->id]) }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit()">Đồng ý</a>
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
              {{ $maintenances->links() }}
            </div> --}}
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
    Bảo dưỡng - sửa chữa
@endsection

@section('js-custom')
<script>
  $(function () {
    new DataTable('#maintenance', {
        responsive: true
    });
  
    $('input[name="khoang_thoi_gian"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="khoang_thoi_gian"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('input[name="khoang_thoi_gian"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $('.toast').toast('show');
    
  });

</script>
@endsection