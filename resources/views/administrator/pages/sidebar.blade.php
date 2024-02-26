<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('administrator/dist/img/AdminBMTLogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3">
    <span class="brand-text font-weight-light">Bình Minh Tải</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">   
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat " data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview {{ Request::is('vehicle*') || Request::is('transfer*') || Request::is('maintenance*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link sidebar-nav-link {{ Request::is('vehicle*') || Request::is('transfer*') || Request::is('maintenance*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              Quản lý phương tiện
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.vehicle.index') }}" class="nav-link nav-sub-link {{ Request::is('vehicle*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-truck"></i>
                <p>Phương tiện</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.transfer.index') }}" class="nav-link nav-sub-link {{ Request::is('transfer*') ? "active" : '' }}">
                <i class="far fas fa-history nav-icon"></i>
                <p>Lịch sử bàn giao xe</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.maintenance.index') }}" class="nav-link nav-sub-link {{ Request::is('maintenance*') ? "active" : '' }}">
                <i class="far fas fa-tools nav-icon"></i>
                <p>Bảo dưỡng - sửa chữa</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview {{ Request::is('personal*') || Request::is('department*') || Request::is('project*') || Request::is('unit*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link sidebar-nav-link {{ Request::is('personal*') || Request::is('department*') || Request::is('project*') || Request::is('unit*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Quản lý nhân sự
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.personal.index') }}" class="nav-link nav-sub-link {{ Request::is('personal*') ? "active" : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Nhân sự</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.department.index') }}" class="nav-link nav-sub-link {{ Request::is('department*') ? "active" : '' }}">
                <i class="nav-icon fa-solid fa-building-user"></i>
                <p>Phòng ban</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.project.index') }}" class="nav-link nav-sub-link {{ Request::is('project*') ? "active" : '' }}">
                <i class="nav-icon fas fa-project-diagram"></i>
                <p>Dự án</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.unit.index') }}" class="nav-link nav-sub-link {{ Request::is('unit*') ? "active" : '' }}">
                <i class="nav-icon fa-solid fa-building-flag"></i>
                <p>Đơn vị</p>
              </a>
            </li>
          </ul>
        </li>  
        
        <li class="nav-item has-treeview {{ Request::is('stock-in*') || Request::is('supplier*') || Request::is('diesel*') || Request::is('warehouse*') || Request::is('protection*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link sidebar-nav-link {{ Request::is('stock-in*') || Request::is('supplier*') || Request::is('diesel*') || Request::is('warehouse*') || Request::is('protection*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>
              Kho vật tư
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.warehouse.index') }}" class="nav-link nav-sub-link {{ Request::is('warehouse*') ? "active" : '' }}">
                <i class="nav-icon fa-solid fa-boxes-stacked"></i>
                <p>Vật tư</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.stock-in.index') }}" class="nav-link nav-sub-link {{ Request::is('stock-in*') ? "active" : '' }}">
                <i class="nav-icon fas fa-truck-loading"></i>
                <p>Nhập kho</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.supplier.index') }}" class="nav-link nav-sub-link {{ Request::is('supplier*') ? "active" : '' }}">
                <i class="nav-icon fas fa-handshake"></i>
                <p>Nhà cung cấp</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.diesel.index') }}" class="nav-link nav-sub-link {{ Request::is('diesel*') ? "active" : '' }}">
                <i class="nav-icon fas fa-gas-pump"></i>
                <p>Xe đổ dầu(DO)</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.protection.index') }}" class="nav-link nav-sub-link {{ Request::is('protection*') ? "active" : '' }}">
                <i class="nav-icon fas fa-hard-hat"></i>
                <p>Cấp dụng cụ bảo hộ</p>
              </a>
            </li>
          </ul>
        </li>
        
        @if (Auth::user()->role == 1)
          <li class="nav-item has-treeview">
            <a href="{{ route('admin.account.index') }}" class="nav-link sidebar-nav-link {{ Request::is('account*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Quản lý tài khoản
              </p>
            </a>
          </li>
        @endif
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
