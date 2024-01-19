<nav class="main-header navbar navbar-expand navbar-dark navbar-light" id="navbar">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">  
        <i class="fas fa-user mr-2"></i> {{ Auth::user()->email }}
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        {{-- <span class="dropdown-item dropdown-header">Thông tin</span> --}}
        <div class="dropdown-divider"></div>
        <a href="#" data-bs-toggle="modal" data-bs-target="#update-password" class="dropdown-item">
          <i class="fas fa-exchange-alt mr-2"></i> Đổi mật khẩu 
        </a>
        <div class="dropdown-divider"></div>
          <a href="#" data-bs-toggle="modal" data-bs-target="#notification" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
          </a>
      </div>
    </li>
  </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="notification" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Thông tin</h5>
        <button type="button" class="btn" data-bs-dismiss="modal"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"/></svg></button>
      </div>
      <div class="modal-body">
        Bạn muốn đăng xuất?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <a href="{{ route('logout') }}" type="button" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit();">Đồng ý</a>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- update-password -->
@include('administrator.account.update-password')