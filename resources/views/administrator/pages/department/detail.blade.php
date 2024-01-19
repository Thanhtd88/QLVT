@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Phòng ban - Chỉnh sửa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.department.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin phòng ban</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.department.update', ['department' => $department->id]) }}">
                            @method('PATCH')
                            @csrf 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tên đơn vị</label>
                                    <input type="text" class="form-control" id="name" name='phong_ban' value="{{ old('phong_ban') ?? $department->phong_ban }}">
                                    @error('phong_ban')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') ?? $department->slug }}">
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
          url: '{{ route('admin.department.slug') }}',  // action of form
          data: {
            phong_ban: nameValue,
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
    Phòng ban
@endsection