<!--
  Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

  Tip 2: you can also add an image using data-image tag
-->
<style type="text/css">
  .dropdown-toggle::after {
    content: none;
  }

</style>

<div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
    Kependudukan
  </a></div>
<div class="sidebar-wrapper">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/') }}">
        <i class="material-icons">dashboard</i>
        <p>Beranda</p>
      </a>
    </li>

    <?php
    $acl = \App\Models\Role::where(function ($query) {
        $query->where('id', \Auth::user()->role_id)
              ->where('route_access_list', 'LIKE', '%'.'agama.index'.'%');
    })->where(function ($query) {
        $query->where('id', \Auth::user()->role_id)
              ->where('route_access_list', 'LIKE', '%'.'kategori.index'.'%');
    })
    ->count();
    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
    ?>
    @if($acl != 0 || $admin == 'admin')
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">content_paste</i>
        <p>Master Data</p>
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ url('/agama') }}">Agama</a></li>

      </ul>
    </li>
    @endif

    <?php
    $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'kk.index'.'%')->count();
    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
    ?>
    @if($acl != 0 || $admin == 'admin')
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">person</i>
        <p>Penduduk</p>
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ url('/kk') }}">Kartu Keluarga</a></li>
        <li><a class="dropdown-item" href="{{ url('/penduduk') }}">Data Penduduk</a></li>
      </ul>
    </li>
    @endif

    <?php
    $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'kk_user.index'.'%')->count();
    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
    ?>
    @if($acl != 0 && $admin != 'admin')
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:;" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">person</i>
        <p>Data Pribadi</p>
      </a>
      <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ url('/kk_user') }}">Kartu Keluarga</a></li>
        <?php
        $penduduk = \App\Models\Penduduk::where('user_id', \Auth::user()->id)->first();
        if($penduduk){ ?>
          <li><a class="dropdown-item" href="{{ url('/individu') }}/{{ $penduduk->nik }}">Individu</a></li>
        <?php }
        ?>

      </ul>
    </li>
    @endif

    <?php
    $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'role.index'.'%')->count();
    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
    ?>
    @if($acl != 0 || $admin == 'admin')
    <li class="nav-item ">
      <a class="nav-link" href="{{ url('/role') }}">
        <i class="material-icons">library_books</i>
        <p>Manajemen Akses</p>
      </a>
    </li>
    @endif

    <?php
    $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'pengguna.index'.'%')->count();
    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
    ?>
    @if($acl != 0 || $admin == 'admin')
    <li class="nav-item ">
      <a class="nav-link" href="{{ url('/pengguna') }}">
        <i class="material-icons">language</i>
        <p>Manajemen Pengguna</p>
      </a>
    </li>
    @endif

    <?php
    $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'desa.index'.'%')->count();
    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
    ?>
    @if($acl != 0 || $admin == 'admin')

    <li class="nav-item ">
      <a class="nav-link" href="{{ url('/desa') }}">
        <i class="material-icons">bubble_chart</i>
        <p>Manajemen Desa</p>
      </a>
    </li>
     @endif
    <!-- <li class="nav-item ">
      <a class="nav-link" href="./map.html">
        <i class="material-icons">location_ons</i>
        <p>Surat Keterangan</p>
      </a>
    </li> -->

  </ul>
</div>
