<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard.index')}}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">DASHBOARD</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('dashboard.index')}}  ">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    SHOP
  </div>

  <!-- Nav Itemm - Category Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('voucher.index')}}">
      <i class="fas fa-file-invoice-dollar"></i>
      <span>Mã Giảm Giá</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('category.index')}}">
      <i class="far fa-list-alt"></i>
      <span>Danh Mục</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('user.index')}}">
      <i class="fas fa-users"></i>
      <span>Tài Khoản</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('file-manager')}}">
      <i class="fas fa-folder-open"></i>
      <span>Quản Lý Tập Tin</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>