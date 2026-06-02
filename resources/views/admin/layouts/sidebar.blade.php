<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('template-admin/src/assets/images/logos/logo.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                {{-- Tampilan Menu Untuk Admin --}}
                @if (Auth::user()->role == 'Admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item {{ Request::is('dashboard') ? 'selected' : '' }}">
                        <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    {{-- MENU DATAMASTER --}}
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Datamaster</span>
                    </li>
                    <li class="sidebar-item {{ Request::is('users*') ? 'selected' : '' }}">
                        <a class="sidebar-link {{ Request::is('users*') ? 'active' : '' }}"
                            href="{{ route('users.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Data Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('category*') ? 'selected' : '' }}">
                        <a class="sidebar-link {{ Request::is('category*') ? 'active' : '' }}"
                            href="{{ route('category.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-category"></i>
                            </span>
                            <span class="hide-menu">Data Category</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('item*') ? 'selected' : '' }}">
                        <a class="sidebar-link {{ Request::is('item*') ? 'active' : '' }}"
                            href="{{ route('item.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-box"></i>
                            </span>
                            <span class="hide-menu">Data Item</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Transaksi</span>
                    </li>
                    <li class="sidebar-item {{ Request::is('loan*') ? 'selected' : '' }}">
                        <a class="sidebar-link {{ Request::is('loan*') ? 'active' : '' }}"
                            href="{{ route('loan.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-clipboard-text"></i>
                            </span>
                            <span class="hide-menu">Peminjaman</span>
                        </a>
                    </li>
                @elseif (Auth::user()->role == 'Siswa')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item {{ Request::is('profil') ? 'selected' : '' }}">
                        <a class="sidebar-link {{ Request::is('profil') ? 'active' : '' }}"
                            href="{{ route('profile') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Profil Saya</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
