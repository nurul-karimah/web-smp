<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100vh; overflow-y: auto;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SI PAUD Plamboyan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        @auth
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('storage/users/' . Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        @endauth

        <!-- Sidebar Search -->
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
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-widget="treeview" data-accordion="false">

                <li class="nav-header">NAVIGASI UTAMA</li>

                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-gauge nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('showorangtua') }}" class="nav-link {{ request()->routeIs('showorangtua') ? 'active' : '' }}">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a href="{{ route('showGuru') }}" class="nav-link {{ request()->routeIs('showGuru') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Guru</p>
                    </a>
                </li>

                <li class="nav-header">LAINNYA</li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-ellipsis-v nav-icon"></i>
                        <p>
                            Lainnya
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="nav-link"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Log Out</p>
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
