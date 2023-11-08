<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
        <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" id="fotoprofil_sidebar">
            @if(Auth::user()->data_akun->foto != null)
            <img src="{{ asset('storage/foto/'.Auth::user()->data_akun->foto) }}" class="img-circle elevation-2" alt="User Image">
            @else
            <img src="{{ asset('storage/foto/default.png') }}" class="img-circle elevation-2" alt="User Image">
            @endif
        </div>
        <div class="info">
            <a class="d-block">{{ Auth::user()->data_akun->nama }}</a>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        @if (Auth::user()->role_akun->role == 'admin' || Auth::user()->role_akun->role == 'user')
        <li class="nav-item">
            <a href="/dashboard" class="nav-link {{$title==='Dashboard' ? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/barang" class="nav-link {{$title==='Stock Barang' ? 'active' : ''}}">
            <i class="nav-icon fas fa-th-list"></i>
                <p>Stock Barang</p>
            </a>
        </li>
        <li class="nav-item {{$title==='Barang Masuk'||$title==='Barang Keluar' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{$title==='Barang Masuk'||$title==='Barang Keluar' ? 'active' : ''}}">
                <i class="nav-icon fas fa-table"></i>
                    <p>Transaksi Barang<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 3px">
                <li class="nav-item">
                    <a href="/masuk" class="nav-link {{$title==='Barang Masuk' ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Barang Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/keluar" class="nav-link {{$title==='Barang Keluar' ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Barang Keluar</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{$title==='Jenis Barang'||$title==='Merek Barang'||$title==='Satuan Barang'||$title==='Lokasi Barang' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{$title==='Jenis Barang'||$title==='Merek Barang'||$title==='Satuan Barang'||$title==='Lokasi Barang' ? 'active' : ''}}">
                <i class="nav-icon fas fa-table"></i>
                    <p>Form<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" style="margin-left: 3px">
                <li class="nav-item">
                    <a href="/jenis" class="nav-link {{$title==='Jenis Barang' ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jenis</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview" style="margin-left: 3px">
                <li class="nav-item">
                    <a href="/merek" class="nav-link {{$title==='Merek Barang' ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Merek</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview" style="margin-left: 3px">
                <li class="nav-item">
                    <a href="/satuan" class="nav-link {{$title==='Satuan Barang' ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Satuan</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview" style="margin-left: 3px">
                <li class="nav-item">
                    <a href="/lokasi" class="nav-link {{$title==='Lokasi Barang' ? 'active' : ''}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lokasi</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->role_akun->role == 'admin')
        <li class="nav-item">
            <a href="/user" class="nav-link {{$title==='Data User' ? 'active' : ''}}">
            <i class="nav-icon fas fa-users"></i>
                <p>Data User</p>
            </a>
        </li>  
        @endif
        @if (Auth::user()->role_akun->role == 'admin' || Auth::user()->role_akun->role == 'user')
        <li class="nav-item">
            <a href="/pengaturan" class="nav-link {{$title==='Pengaturan' ? 'active' : ''}}">
            <i class="nav-icon fas fa-cog"></i>
                <p>Pengaturan</p>
            </a>
        </li> 
        @endif
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>