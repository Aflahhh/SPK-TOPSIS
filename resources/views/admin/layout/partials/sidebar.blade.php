<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if (Auth::user()->role == 'admin')
            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? '' : 'collapsed' }}" href="/">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('users') ? 'active' : 'collapsed' }}"
                    href="{{ route('users.index') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Data User</span>
                </a>
            </li>

            {{-- Data Pegawai --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('pegawai*') ? 'active' : 'collapsed' }}" href="/pegawai">
                    <i class="bi bi-people"></i>
                    <span>Data Pegawai</span>
                </a>
            </li>

            {{-- Master Data --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('master*') ? '' : 'collapsed' }}" data-bs-target="#components-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i> <span>Master Data</span> <i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse {{ request()->is('master*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('jabatan.index') }}"
                            class="{{ request()->is('master/jabatan') ? 'active' : 'collapse' }}">
                            <i class="bi bi-circle"></i><span>Data Jabatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('golongan.index') }}"
                            class="{{ request()->is('master/golongan') ? 'active' : 'collapse' }}">
                            <i class="bi bi-circle"></i><span>Data Golongan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mapel.index') }}"
                            class="{{ request()->is('master/mapel') ? 'active' : 'collapse' }}">
                            <i class="bi bi-circle"></i><span>Data Mapel</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        {{-- Pensiun --}}
        {{-- <li class="nav-item">
        <a class="nav-link {{ request()->is('pensiun') ? 'active' : 'collapsed' }}" href="/pensiun">
          <i class="bi bi-calendar-range"></i>
          <span>Pensiun</span>
        </a>       
      </li> --}}


        {{-- Kinerja --}}
        {{-- <li class="nav-item">
        <a class="nav-link {{ request()->is('kinerja') ? 'active' : 'collapsed' }}" href="#">
          <i class="bi bi-bar-chart-line"></i>
          <span>Evaluasi Kinerja</span>
        </a>        
      </li>  --}}


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : 'collapsed' }}" href="/">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : 'collapsed' }}" href="/">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li>

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>


</aside><!-- End Sidebar-->
