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
                    <h1>Đơn Vị - Chỉnh sửa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.unit.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin đơn vị</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.unit.update', ['unit' => $unit->id]) }}">
                            @method('PATCH')
                            @csrf 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tenpb">Tên đơn vị</label>
                                    <input type="text" class="form-control" id="name" name='don_vi' value="{{ old('don_vi') ?? $unit->don_vi }}">
                                    @error('don_vi')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') ?? $unit->slug }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Ngày tạo</label>
                                    <input type="text" class="form-control" value="{{ $unit->created_at }}" readonly='true'>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Ngày cập nhật</label>
                                    <input type="text" class="form-control" value="{{ $unit->updated_at }}" readonly='true'>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Ngày xóa</label>
                                    <input type="text" class="form-control" value="{{ $unit->deleted_at }}" readonly='true'>
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

@section('js-custom')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#name').on('keyup', function(){
        var nameValue = $(this).val();
        $.ajax({
          method: 'POST', // method of form
          url: '{{ route('admin.unit.slug') }}',  // action of form
          data: {
            don_vi: nameValue,
            _token: '{{ csrf_token() }}'
          },
          success: function(response){
            $('#slug').val(response.slug);
          }
        })
      });
    });
  </script>
@endsection

@section('title')
    Đơn vị
@endsection