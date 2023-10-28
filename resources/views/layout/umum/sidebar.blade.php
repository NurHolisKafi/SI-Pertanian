        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex flex-column my-1 my-sm-5 align-items-center justify-content-center"
                href="index.html">
                <img src="../img/logo-sip.png" class="img-fluid rounded-sm" width="80%">
                <div class="sidebar-brand-text mx-3 text-uppercase mb-4" style="font-size: 0.8rem;">sistem informasi
                    pertanian
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @yield('profile-active')">
                <a class="nav-link" href="/umum/profile">
                    <i class="fas fa-fw fa-user"></i>
                    <span>My Profile</span></a>
            </li>
            <li class="nav-item @yield('chat-active')">
                <a class="nav-link" href="/umum/chat">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>Chat</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->