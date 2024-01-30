@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dự án - Tạo mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.project.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin dự án</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('admin.project.store') }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tenpb">Tên dự án</label>
                                    <x-text-input id="name" type="text" class="form-control" :errors="$errors" name="du_an" :value="old('du_an')" required />
                                    <x-input-error :messages="$errors->get('du_an')" class="mt-2" style="color: red"/>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" readonly>
                                </div>          
                                @csrf              
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
          url: '{{ route('admin.project.slug') }}',  // action of form
          data: {
            du_an: nameValue,
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
    Dự án
@endsection