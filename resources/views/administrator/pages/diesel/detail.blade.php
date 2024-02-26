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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dầu DO - Chỉnh sửa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.diesel.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
                <div class="col-md-12">
                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin xe đổ dầu</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.diesel.update', ['diesel' => $diesel->id]) }}">         
                            @csrf
                            @method('PATCH')
                            <div class="card-body">   
                                <div class="form-group">
                                    <label for="">Nơi đổ</label>
                                    <select class="form-control" name="noi_do" id="">
                                        <option value="">--Lựa chọn--</option>
                                        <option {{ $diesel->noi_do == 0 ? 'selected' : '' }} value="0">Bình Hòa</option>
                                        <option {{ $diesel->noi_do == 1 ? 'selected' : '' }} value="1">Đông Nhì</option>
                                    </select>
                                    @error('noi_do') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>
                                <div class="input-group mb-3">
                                    <label for="">Ngày đổ</label>
                                    <div class="input-group date reservationdate" id="ngay_do" data-target-input="nearest">
                                        <input name="ngay_do" type="text" value="{{ date('d-m-Y H:i:s', strtotime($diesel->ngay_do)) }}" class="form-control datetimepicker-input" data-target="#ngay_do" />
                                        <div class="input-group-append" data-target="#ngay_do" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-calendar-check"></i></div>
                                        </div>
                                        @error('ngay_do') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_id">Số xe</label>
                                    <select class="form-control select2" style="" id="vehicle_id" name="vehicle_id">
                                        <option selected="selected" value="{{ $diesel->vehicle_id }}">{{ $diesel->vehicle->so_xe }}</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value={{ $vehicle->id }}>{{ $vehicle->so_xe }}</option>
                                        @endforeach                                    
                                    </select>
                                    @error('vehicle_id') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="km">Số km</label>
                                    <input type="number" class="form-control" id="km" name="odo" value="{{ $diesel->odo }}">
                                    @error('odo') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>   
                                <div class="form-group">
                                    <label for="so_lit">Số lít đổ</label>
                                    <input type="number" class="form-control" id="so_lit" name="so_lit" value="{{ $diesel->so_lit }}">
                                    @error('so_lit') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>  
                                <div class="form-group mb-3">
                                    <label for="personal_id">Tài xế</label>
                                    <select class="form-control select2" style="" id="personal_id" name="personal_id">
                                        <option selected="selected" value="{{ $diesel->personal_id }}">{{ $diesel->personal->ho_ten }}</option>
                                        @foreach ($personals as $personal)
                                            <option value={{ $personal->id }}>{{ $personal->ho_ten }}</option>
                                        @endforeach                                    
                                    </select>
                                    @error('personal_id') <span style="color: red">{{ ' *'.$message }}</span>@enderror
                                </div>            
                            </div>                            
                            <!-- /.card-body --> 
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('title')
    Dầu DO
@endsection

@section('js-custom')
<script type="text/javascript">
    $(document).ready(function(){
        $('.toast').toast('show');
    });
    $(function () {
        $('.select2').select2();
        $('.reservationdate').datetimepicker({
            format: 'DD/MM/YYYY hh:mm:ss'
        }); 
    })
</script>
@endsection