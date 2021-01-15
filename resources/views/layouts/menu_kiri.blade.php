<nav class="navbar navbar-expand-sm navbar-default">

    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="./">Sistem Permintaan ATK</a>
        <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
    </div>

    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <?php
        $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
        ?>

        <ul class="nav navbar-nav">
            <li>
                <a href="{{ url('/home') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
            </li>
            <h3 class="menu-title">Menu</h3><!-- /.menu-title -->

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'jenis_barang.list'.'%');
            })
            ->count();

            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/jenis_barang') }}"> <i class="menu-icon fa fa-id-badge"></i>Data Jenis Barang </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'stok_barang.list'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/stok_barang') }}"> <i class="menu-icon fa fa-pencil-square"></i>Data Stok ATK </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'permintaan.list'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/permintaan') }}"> <i class="menu-icon fa fa-bars"></i>Data Permintaan ATK </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'permintaan.jurusan'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/permintaan/jurusan') }}"> <i class="menu-icon fa fa-bars"></i>Data Permintaan ATK </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'pemasukan.list'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/pemasukan') }}"> <i class="menu-icon fa fa-folder"></i>Data Pemasukan ATK </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'pengeluaran.list'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/pengeluaran') }}"> <i class="menu-icon fa fa-briefcase"></i>Data Pengeluaran ATK </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'pengguna.list'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/pengguna') }}"> <i class="menu-icon fa fa-bullseye"></i>Data User </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'role.list'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/role') }}"> <i class="menu-icon fa fa-caret-square-o-up"></i>Hak Akses User </a>
            </li>
            @endif

            <?php
            $acl = \App\Models\Role::where(function ($query) {
                $query->where('id', \Auth::user()->role_id)
                      ->where('route_access_list', 'LIKE', '%'.'permintaan.jurusan.cetak_bpp'.'%');
            })
            ->count();
            ?>

            @if($acl != 0)
            <li>
                <a href="{{ url('/permintaan/jurusan/cetak_bpp') }}"> <i class="menu-icon fa fa-desktop"></i>Cetak BPP </a>
            </li>
            @endif

            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="menu-icon fa fa-share-square-o"></i>Logout </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            <input hidden name="_token" value="{{ csrf_token() }}">
                                        </form>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
