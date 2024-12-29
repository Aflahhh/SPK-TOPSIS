<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        @if (Auth::user()->role === 'admin')
            {{-- Dashboard --}}
            <li class="nav-item">
        <a href="{{ route('dashboard.index') }}"
           class="nav-link {{ request()->is('dashboard') ? 'active' : 'collapsed' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

     {{-- Master Data --}}
     <li class="nav-item">
        <a class="nav-link {{ request()->is('masterData*') ? '' : 'collapsed' }}"
            data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i> <span>Master Data</span> <i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse {{ request()->is('masterData*') ? 'show' : '' }}"
            data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('jabatan.index') }}"
                    class="{{ request()->is('masterData/jabatan') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Jabatan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('status_jabatan.index') }}"
                    class="{{ request()->is('masterData/status_jabatan') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Status Jabatan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('golongan.index') }}"
                    class="{{ request()->is('masterData/golongan') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Golongan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mapel.index') }}"
                    class="{{ request()->is('masterData/mapel') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Mata Pelajaran</span>
                </a>
            </li>

            <li>
                <a href="{{ route('kriteria.index') }}"
                    class="{{ request()->is('masterData/kriteria') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Kriteria</span>
                </a>
            </
            <li>
                <a href="{{ route('subkriteria.index') }}"
                    class="{{ request()->is('masterData/subkriteria') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Sub Kriteria</span>
                </a>
            </li>
        </ul>
    </li>

     {{-- Data Pegawai --}}
     <li class="nav-item">
        <a class="nav-link {{ request()->is('masterPegawai*') ? 'active' : 'collapsed' }}"
            href="{{ route('pegawai.index') }}">
            <i class="bi bi bi-people"></i>
            <span>Data Pegawai</span>
        </a>
    </li>
       
    {{-- Pensiun --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->is('pensiun*') ? '' : 'collapsed' }}"
            data-bs-target="#components-nav4" data-bs-toggle="collapse" href="#">
            <i class="bi bi-opencollective"></i> <span>Pensiun</span> <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav4" class="nav-content collapse {{ request()->is('/penisun') ? 'show' : '' }}"
            data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('pensiun.index') }}"
                    class="{{ request()->is('pensiun') ? 'active' : 'collapse' }}">
                    <i class="bi bi-circle"></i><span>Data Pensiun</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pensiun.index') }}" class="nav-link {{ request()->is('/pensiun') ? 'active' : 'collapsed' }}" >
                    <i class="bi bi-list-stars"></i>
                    <span>Riwayat Pensiun</span>
                </a>
            </li>
        </ul>
    </li>

            {{-- Kinerja --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('kinerja*') ? '' : 'collapsed' }}"
                    data-bs-target="#components-nav5" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-tags"></i> <span>Kinerja</span> <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav5" class="nav-content collapse {{ request()->is('kinerja/kriteria') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('penilaian.penilaianPegawai') }}"
                            class="{{ request()->is('kinerja/penilaian') ? 'active' : 'collapse' }}">
                            <i class="bi bi-circle"></i><span>Penilaian Kinerja</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peringkat') }}" class="nav-link {{ request()->is('kinerja/peringkat') ? 'active' : 'collapsed' }}" >
                            <i class="bi bi-list-stars"></i>
                            <span>Peringkat</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Data User --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->is('users') ? 'active' : 'collapsed' }}"
                    href="{{ route('users.index') }}">
                    <i class="bi bi-person-circle"></i>
                    <span>Data User</span>
                </a>
            </li>

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link">
                    <i class="bi bi-box-arrow-in-right" style="color: black"></i>
                    <span style="color: black">Logout</span>
                </button>
            </form>
        </li>
    </ul>

     {{-- <li class="nav-item">
                <a class="nav-link {{ request()->is('masterPegawai*') ? '' : 'collapsed' }}"
                    data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i> <span>Master Pegawai</span> <i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse {{ request()->is('masterPegawai*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a href="{{ route('pegawai.index') }}"
                            class="{{ request()->is('masterPegawai/pegawai') ? 'active' : 'collapsed' }}">
                            <i class="bi bi-people"></i>
                            <span>Data Pegawai</span>
                        </a>
                    </li>
                </ul>
            </li> --}}

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
      @endif
        @if (Auth::user()->role === 'kepsek')
             {{-- Dashboard --}}
             <li class="nav-item">
                <a href="{{ route('dashboard.index') }}"
                   class="nav-link {{ request()->is('dashboard') ? 'active' : 'collapsed' }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="/kinerja/penilaian"
                   class="nav-link {{ request()->is('kinerja/penilaian') ? 'active' : 'collapsed' }}">
                    <i class="bi bi-person"></i>
                    <span>Data Kriteria Pegawai</span>
                </a>
            </li>

        <li class="border-bottom border-1 border-dark w-100"></li>

        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link" style="color: black">
                    <i class="bi bi-box-arrow-in-right" style="color: black"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>    
       
    @endif
     @if (Auth::user()->role === 'tu')
     {{-- Dashboard --}}
     <li class="nav-item">
        <a href="{{ route('dashboard.index') }}"
           class="nav-link {{ request()->is('dashboard') ? 'active' : 'collapsed' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('peringkat') }}"
           class="nav-link {{ request()->is('peringkat*') ? 'active' : 'collapsed' }}">
            <i class="bi bi-list-stars"></i>
            <span>Peringkat</span>
        </a>
    </li>

    <li class="border-bottom border-1 border-dark w-100"></li>

    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link" style="color: black">
                <i class="bi bi-box-arrow-in-right" style="color: black"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>
        @endif   
    
           


</aside><!-- End Sidebar-->
