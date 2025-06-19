
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100vh; overflow-y: auto;">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SI PAud Plamboyan</span>
  </a>
  

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('storage/orangtua/'. $orangtua->foto) }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ $orangtua->nama }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
       
       
       
       
       
      
      
        <li class="nav-header">MULTI LEVEL EXAMPLE</li>
        <li class="nav-item mb-3">
          <a href="{{ url('/orangtua/dashboard') }}" class="nav-link">
              <i class="fa-solid fa-gauge me-3"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ url('/orangtua/rekapBelajar') }}" class="nav-link">
              <i class="fa-solid fa-gauge me-3"></i>
            <p>Rekap Pendidikan Siswa</p>
          </a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ url('/orangtua/profile') }}" class="nav-link">
              <i class="fa-solid fa-gauge me-3"></i>
            <p>Profile</p>
          </a>
        </li>
        <li class="nav-item mb-3">
          <a href="{{ url('/absensi') }}" class="nav-link">
              <i class="fa-solid fa-gauge me-3"></i>
            <p>Abesensi</p>
          </a>
        </li>
        <li class="nav-item mb-3">
          <a href="#" class="nav-link">
              <i class="fa-solid fa-ellipsis-vertical me-3"></i>

            <p>
              Lainnya
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('Profile') }}</p>
              </a>
            </li>
           
            <li class="nav-item">

              <form method="POST" action="{{ url('/orangtua/logout') }}">
                @csrf

                <a href="{{ url('/orangtua/logout') }}"  onclick="event.preventDefault();
                                        this.closest('form').submit();" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>{{ __('Log Out') }}</p>
                                        
                                      </a>

              </form>
             
            </li>
          </ul>
        </li>
       
        
       
       
      
       
        
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>