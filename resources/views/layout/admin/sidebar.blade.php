        <!-- Sidebar -->
        <ul class="navbar-nav sidebar bg-gradient-dark sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex flex-column my-1 my-sm-5 align-items-center justify-content-center"
                href="index.html">
                <img src="{{ asset('/img/admin.png') }}"  class="img-fluid rounded-sm bg-transparent mt-3 mb-2" width="50%">
                <div class="sidebar-brand-text mx-3 text-uppercase mb-4" style="font-size: 1rem;">admin
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('dashboard-active')">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item @yield('user-active')">
                <a class="nav-link" href="/admin/umum">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>
            {{-- <li class="nav-item @yield('user-active')">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Type:</h6>
                        <a class="collapse-item" href="/admin/umum">Umum</a>
                        <a class="collapse-item" href="/admin/petani">Petani</a>
                    </div>
                </div>
            </li> --}}
            <li class="nav-item @yield('news-active')">
                <a class="nav-link" href="{{ route('news.index') }}">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Berita</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-server"></i>
                    <span>Data Tanaman</span>
                </a>
                <div id="collapseData" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="{{ route('budidaya.index') }}">Budidaya</a>
                        <a class="collapse-item" href="{{ route('kebutuhantanam.index') }}">Kebutuhan Tanam</a>
                        <a class="collapse-item" href="{{ route('bahan.index') }}">Bahan dan Peralatan</a>
                        <a class="collapse-item" href="{{ route('tanaman.index') }}">Jenis Tanaman</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->