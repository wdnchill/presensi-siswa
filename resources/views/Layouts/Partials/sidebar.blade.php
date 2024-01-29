<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img position-relative mt-2 mx-auto">
                <img src="{{ asset('assets/images/logos/logo.png') }}" width="130px" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @if (auth()->user()->role == 'admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item{{ Request::is('beranda*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('beranda') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout-dashboard"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">HALAMAN</span>
                    </li>
                    <li class="sidebar-item{{ Request::is('user*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('user.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Data user</span>
                        </a>
                    </li>
                    <li class="sidebar-item{{ Request::is('kelas*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('kelas.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-chalkboard"></i>
                            </span>
                            <span class="hide-menu">Kelas</span>
                        </a>
                    </li>
                    <li class="sidebar-item{{ Request::is('siswa*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('siswa.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-school"></i>
                            </span>
                            <span class="hide-menu">Data Siswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item{{ Request::is('mapel*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('mapel.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-notebook"></i>
                            </span>
                            <span class="hide-menu">Data Mapel</span>
                        </a>
                    </li>
                    <li class="sidebar-item{{ Request::is('presensi*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('presensi.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-writing"></i>
                            </span>
                            <span class="hide-menu">Presensi siswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item{{ Request::is('laporan*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('laporan') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-report"></i>
                            </span>
                            <span class="hide-menu">Laporan presensi</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">AUTH</span>
                    </li>
                    <li class="sidebar-item{{ Request::is('logout*') ? ' active' : '' }}">
                        <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="true"
                            onclick="modal_logout()">
                            <span>
                                <i class="ti ti-logout"></i>
                            </span>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </li>
            </ul>
        </nav>
    </div>
    @endif
    @if (auth()->user()->role == 'walas' || auth()->user()->role == 'guru')
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item{{ Request::is('beranda*') ? ' active' : '' }}">
            <a class="sidebar-link" href="{{ route('beranda') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item{{ Request::is('presensi*') ? ' active' : '' }}">
            <a class="sidebar-link" href="{{ route('presensi.index') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-writing"></i>
                </span>
                <span class="hide-menu">Presensi siswa</span>
            </a>
        </li>
        <li class="sidebar-item{{ Request::is('laporan*') ? ' active' : '' }}">
            <a class="sidebar-link" href="{{ route('laporan') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-report"></i>
                </span>
                <span class="hide-menu">Laporan presensi</span>
            </a>
        </li>
        <li class="nav-small-cap">
            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
            <span class="hide-menu">AUTH</span>
        </li>
        <li class="sidebar-item{{ Request::is('logout*') ? ' active' : '' }}">
            <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="true" onclick="modal_logout()">
                <span>
                    <i class="ti ti-logout"></i>
                </span>
                <span class="hide-menu">Logout</span>
            </a>
        </li>
    @endif
</aside>
<script>
    function modal_logout() {
        Swal.fire({
            title: 'Peringtan',
            text: 'Apakah kamu yakin ingin logout?',
            icon: 'warning',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            showCancelButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ route('logout') }}";
            }
        })
    }
</script>
