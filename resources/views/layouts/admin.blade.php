<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Laravel SB Admin 2">
  <meta name="author" content="Alejandro RH">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

  <!-- Favicon -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @include('sweetalert::alert')
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-pie-chart"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK BEON</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Nav::isRoute('home') }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fa-solid fa-house"></i>
          <span>{{ __('Dashboard') }}</span></a>
      </li>

      <li class="nav-item {{ Nav::isRoute('alternatif*') }}">
        <a class="nav-link" href="{{ route('alternatif.index') }}">
          <i class="fa fa-users"></i>
          <span>{{ __('Alternatif') }}</span></a>
      </li>

      <li class="nav-item {{ Nav::isRoute('kriteria*') }}">
        <a class="nav-link" href="{{ route('kriteria.index') }}">
          <i class="fa fa-address-card"></i>
          <span>{{ __('Kriteria') }}</span></a>
      </li>

      <li class="nav-item {{ Nav::isRoute('sub-kriteria*') }}">
        <a class="nav-link" href="{{ route('sub-kriteria.index') }}">
          <i class="fa fa-file-text"></i>
          <span>{{ __('Sub Kriteria') }}</span></a>
      </li>

      <li class="nav-item {{ Nav::isRoute('role*') }}">
        <a class="nav-link" href="{{ route('role.index') }}">
          <i class="fa fa-user-circle"></i>
          <span>{{ __('Role') }}</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      @if (Auth::user()->role != 'admin')
        <li class="nav-item {{ Nav::isRoute('penilaian*') }}">
          <a class="nav-link" href="{{ route('penilaian.index') }}">
            <i class="fa fa-fax"></i>
            <span>{{ __('Penilaian') }}</span></a>
        </li>
      @endif

      <li class="nav-item {{ Nav::isRoute('hasil-penilaian*') }}">
        <a class="nav-link" href="{{ route('hasil-penilaian.index') }}">
          <i class="fa fa-bar-chart"></i>
          <span>{{ __('Hasil Penilaian') }}</span></a>
      </li>

      <li class="nav-item {{ Nav::isRoute('borda*') }}">
        <a class="nav-link" href="{{ route('borda.index') }}">
          <i class="fa fa-list-ol"></i>
          <span>{{ __('Hasil Borda') }}</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        {{ __('Settings') }}
      </div>

      <!-- Nav Item - Profile -->
      <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
          <i class="fas fa-fw fa-user"></i>
          <span>{{ __('Profile') }}</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="d-none d-md-inline text-center">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light topbar static-top mb-4 bg-white shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

      

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right animated--grow-in p-3 shadow"
                aria-labelledby="searchDropdown">
                <form class="form-inline w-100 navbar-search mr-auto">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light small border-0" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="d-none d-lg-inline small mr-2 text-gray-600">{{ Auth::user()->name }}</span>
                <figure class="img-profile rounded-circle avatar font-weight-bold"
                  data-initial="{{ Auth::user()->name[0] }}"></figure>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right animated--grow-in shadow" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('profile') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ __('Profile') }}
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ __('Logout') }}
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('main-content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
          <a class="btn btn-danger" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
