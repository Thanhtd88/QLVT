<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('administrator/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('administrator/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('administrator/dist/css/admin.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('administrator/dist/css/login.css') }}">
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
            <div class="container">
            <a class="navbar-brand">
                <img src="{{ asset('administrator/dist/img/AdminBMTLogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Công ty TNHH Bình Minh Tải</span>
            </a>
            
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a href="http:\\binhminhtai.net.vn/gioi-thieu" class="nav-link" target="_blank">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="fas fa-phone-volume"></i> 0859 881 229</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <section class="content-wrapper">
            <div class="background-cont">
                <img src="{{ asset('administrator/dist/img/container-background.png') }}" alt="">
            </div>
            <div class="background-line">
                <img src="{{ asset('administrator/dist/img/line-background.png') }}" alt="">
            </div>
            <div class="login">
                <div class="row">
                <!-- left column -->
                    <div class="col-md-4 login-content">
                        <div class="cart-login">
                            <div class="card-header">
                            <h3 class="card-title text-white">Đăng nhập</h3>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="form-horizontal">
                                @csrf
                                <div class="card-body">
                                    <!-- Email Address -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input id="email" class="form-control text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email"/>
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-white" />

                                        
                                    <!-- Password -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text text-white"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input id="password" class="form-control text-white" type="password" name="password" required autocomplete="current-password" placeholder="Mật khẩu"/>
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-white" />
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="offset-sm-2">
                                                {{-- <div class="form-check">
                                                    <label for="remember_me" class="inline-flex items-center form-check-label">
                                                        <input id="remember_me" type="checkbox" class="form-check-input rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                                        <span class="ms-2 text-sm text-gray-600">{{ __('Nhớ mật khẩu') }}</span>
                                                    </label>
                                                </div> --}}
                                                <div class="form-group clearfix">
                                                    <div class="icheck-primary d-inline text-white">
                                                        <input type="checkbox" id="show-password">
                                                        <label for="show-password"> Hiện mật khẩu
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="ms-3 btn btn-primary float-right"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
    </div>
    @include('administrator.pages.footer')
    

    <script>
        window.addEventListener("DOMContentLoaded", function () {
        const togglePassword = document.querySelector("#show-password");
            togglePassword.addEventListener("click", function (e) {
                // toggle the type attribute
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
            });
        });
    </script>        
</body>
</html>
    
