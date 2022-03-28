
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#"> 
                <img src="{{ asset('assets/img/logo.png') }}" alt="" style="width: 40px;"> SMAN 1 Darangdan
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img src="{{ asset('assets/img/logo.png') }}" alt="" style="width: 40px;"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <!-- Dashboard  -->
            <li class="{{ setActive(['dashboard*']) }}">
                <a class="nav-link" href="{{ url('/dashboard') }}"><i class="fas fa-file"></i> <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Menu</li>

            @if(Auth::user()->role_id === 1)
            <!-- Modul 1 -->
                <!-- Pegawai CLEAR !! -->
                <li class="{{ setActive(['pegawai*']) }}">
                    <a class="nav-link" href="{{ url('/pegawai') }}"><i class="fas fa-users"></i> <span>Pegawai</span></a>
                </li>
                
            @elseif(Auth::user()->role_id === 2)

                <!-- Perencanaan  -->
                <li class="{{ setActive(['perencanaan*']) }}">
                    <a class="nav-link" href="{{ url('/perencanaan') }}"><i class="fas fa-file"></i> <span>Perencanaan</span></a>
                </li>

                <!-- Pengajuan CLEAR !! -->
                <li class="{{ setActive(['pengajuan*']) }}">
                    <a class="nav-link" href="{{ url('/pengajuan') }}"><i class="fas fa-book"></i> <span>Pengajuan</span></a>
                </li>
                
                <!-- Aset CLEAR !! -->
                <li class="{{ setActive(['aset*', 'pembelian*']) }}">
                    <a class="nav-link" href="{{ url('/aset/data/masuk') }}"><i class="fas fa-book-open"></i> <span>Aset</span></a>
                </li>

                <!-- Ruangan CLEAR !! -->
                <li class="{{ setActive(['ruangan*']) }}">
                    <a class="nav-link" href="{{ url('/ruangan') }}"><i class="fas fa-home"></i> <span>Ruangan</span></a>
                </li>
                
                <!-- Pemeliharaan  -->
                <li class="{{ setActive(['pemeliharaan*']) }}">
                    <a class="nav-link" href="{{ url('/pemeliharaan') }}"><i class="fas fa-sync-alt"></i> <span>Pemeliharaan</span></a>
                </li>

                <!-- Penyusutan  -->
                <li class="{{ setActive(['penyusutan*']) }}">
                    <a class="nav-link" href="{{ url('/penyusutan') }}"><i class="fas fa-trash"></i> <span>Penyusutan</span></a>
                </li>
                
                <!-- Laporan -->
                <!-- <li class="{{ setActive(['laporan*']) }}">
                    <a class="nav-link" href="{{ url('/laporan') }}"><i class="fas fa-trash"></i> <span></span></a>
                </li>    -->
                <!-- <li class="nav-item dropdown {{ setActive(['laporan*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive('laporan/aset') }}"><a class="nav-link" href="{{ url('/laporan/aset') }}">Laporan Aset</a></li>
                        <li class="{{ setActive('laporan/pengajuan') }}"><a class="nav-link" href="{{ url('/laporan/pengajuan') }}">Laporan Pengajuan</a></li>
                        <li class="{{ setActive('laporan/pemeliharaan') }}"><a class="nav-link" href="{{ url('/laporan/pemeliharaan') }}">Laporan Pemeliharaan</a></li>
                        <li class="{{ setActive('laporan/penyusutan') }}"><a class="nav-link" href="{{ url('/laporan/penyusutan') }}">Laporan Penyusutan</a></li>
                    </ul>
                </li> -->

            @else 
                <!-- Pengajuan CLEAR !! -->
                <li class="{{ setActive(['pengajuan*']) }}">
                    <a class="nav-link" href="{{ url('/pengajuan') }}"><i class="fas fa-book"></i> <span>Pengajuan</span></a>
                </li>

                <!-- Laporan -->
                <li class="nav-item dropdown {{ setActive(['laporan*']) }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Laporan</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive('laporan/aset') }}"><a class="nav-link" href="{{ url('/laporan/aset') }}">Laporan Aset</a></li>
                        <li class="{{ setActive('laporan/pengajuan') }}"><a class="nav-link" href="{{ url('/laporan/pengajuan') }}">Laporan Pengajuan</a></li>
                        <li class="{{ setActive('laporan/pemeliharaan') }}"><a class="nav-link" href="{{ url('/laporan/pemeliharaan') }}">Laporan Pemeliharaan</a></li>
                        <li class="{{ setActive('laporan/penyusutan') }}"><a class="nav-link" href="{{ url('/laporan/penyusutan') }}">Laporan Penyusutan</a></li>
                    </ul>
                </li>

                <!-- Monitoring -->
                <li class="{{ setActive(['monitoring*']) }}">
                    <a class="nav-link" href="{{ url('/monitoring') }}"><i class="fas fa-desktop"></i> <span>Monitoring</span></a>
                </li>


            @endif 

        </ul>
        
    </aside>
</div>