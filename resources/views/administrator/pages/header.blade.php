<nav class="main-header navbar navbar-expand navbar-dark" id="navbar">
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
        <i class="fas fa-user mr-2"></i> {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        {{-- <span class="dropdown-item dropdown-header">Thông tin</span> --}}
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
<div class="modal fade" id="notification" tabindex="-1" aria-labelledby="create-account" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="create-account">Thông tin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@include('administrator.pages.account.update-password')

@section('js-custom')

@endsection