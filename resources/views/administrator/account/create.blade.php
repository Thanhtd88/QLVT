@extends('administrator.layout.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tài khoản - Tạo mới</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.account.index') }}" class="btn btn-primary"><i class="fas fa-chevron-left"></i></a></li>
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
                            <h3 class="card-title">Thông tin tài khoản</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.account.store') }}">
                            @csrf
                            <div class="card-body">
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="tenpb">Họ tên</label>
                                    <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <!-- Email Address -->
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <label for="">Mật khẩu</label>
                  
                                    <div class="input-group" id="show_hide_password">
                                        <x-text-input id="password" class="form-control"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />
                    
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="">Xác nhận mật khẩu</label>
                  
                                    <div class="input-group" id="show_hide_password_confirmation">
                                        <x-text-input id="password_confirmation" class="form-control"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                    
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ms-4 btn btn-primary">
                                        <i class="fas fa-save"></i> Lưu
                                    </x-primary-button>
                                </div>
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
    Tài khoản
@endsection

@section('js-custom')
<script>
    $(document).ready(function() {
        $("#show_hide_password span").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
        $("#show_hide_password_confirmation span").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password_confirmation input').attr("type") == "text"){
                $('#show_hide_password_confirmation input').attr('type', 'password');
                $('#show_hide_password_confirmation i').addClass( "fa-eye-slash" );
                $('#show_hide_password_confirmation i').removeClass( "fa-eye" );
            }else if($('#show_hide_password_confirmation input').attr("type") == "password"){
                $('#show_hide_password_confirmation input').attr('type', 'text');
                $('#show_hide_password_confirmation i').removeClass( "fa-eye-slash" );
                $('#show_hide_password_confirmation i').addClass( "fa-eye" );
            }
        });
    });
</script>       
@endsection
