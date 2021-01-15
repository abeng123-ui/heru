@extends('layouts.master')

@section('content')

<!-- <div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div> -->

<?php
$acl = \App\Models\Role::where(function ($query) {
    $query->where('id', \Auth::user()->role_id)
          ->where('route_access_list', 'LIKE', '%'.'permintaan.list'.'%');
})
->count();
?>

@if($acl != 0)
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <!-- <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div class="dropdown-menu-content">
                        <a style="color: #FFF" class="dropdown-item" href="#">Action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Another action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div> -->
            <h4 class="mb-0">

                <a style="color: #FFF" href="{{ url('/permintaan') }}">
                    <span class="count" style="font-size: 17px">Data Permintaan ATK</span>
                </a>
            </h4>

                <a style="color: #FFF" href="{{ url('/permintaan') }}">
                    <p class="text-light">Data Permintaan</p>
                </a>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>
@endif

<?php
    $acl = \App\Models\Role::where(function ($query) {
        $query->where('id', \Auth::user()->role_id)
              ->where('route_access_list', 'LIKE', '%'.'permintaan.jurusan'.'%');
    })
    ->count();
    ?>

    @if($acl != 0)

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <!-- <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a style="color: #FFF" class="dropdown-item" href="#">Action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Another action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div> -->
            <h4 class="mb-0">

                <a style="color: #FFF" href="{{ url('/permintaan/jurusan') }}">
                    <span class="count" style="font-size: 17px">Data Permintaan ATK</span>
                </a>
            </h4>

            <a style="color: #FFF" href="{{ url('/permintaan/jurusan') }}">
                <p class="text-light">Data Permintaan</p>
            </a>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart1"></canvas>
            </div>

        </div>

    </div>
</div>
@endif


<?php
    $acl = \App\Models\Role::where(function ($query) {
        $query->where('id', \Auth::user()->role_id)
              ->where('route_access_list', 'LIKE', '%'.'pengeluaran.list'.'%');
    })
    ->count();
    ?>

    @if($acl != 0)
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <!-- <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a style="color: #FFF" class="dropdown-item" href="#">Action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Another action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div> -->
            <h4 class="mb-0">

                <a style="color: #FFF" href="{{ url('/pengeluaran') }}">
                    <span class="count" style="font-size: 17px">Data Pengeluaran ATK</span>
                </a>
            </h4>

            <a style="color: #FFF" href="{{ url('/pengeluaran') }}">
                <p class="text-light">Data Pengeluaran</p>
            </a>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <canvas id="widgetChart4"></canvas>
            </div>

        </div>
    </div>
</div>
@endif

<?php
    $acl = \App\Models\Role::where(function ($query) {
        $query->where('id', \Auth::user()->role_id)
              ->where('route_access_list', 'LIKE', '%'.'stok_barang.list'.'%');
    })
    ->count();
    ?>

    @if($acl != 0)
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <!-- <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <div class="dropdown-menu-content">
                        <a style="color: #FFF" class="dropdown-item" href="#">Action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Another action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div> -->
            <h4 class="mb-0">

                <a style="color: #FFF" href="{{ url('/stok_barang') }}">
                    <span class="count" style="font-size: 17px">Data Stok ATK</span>
                </a>

            </h4>

            <a style="color: #FFF" href="{{ url('/stok_barang') }}">
                <p class="text-light">Data Stok</p>
            </a>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="widgetChart2"></canvas>
            </div>

        </div>
    </div>
</div>
@endif
<!--/.col-->

<!-- <div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                    <i class="fa fa-cog"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <div class="dropdown-menu-content">
                        <a style="color: #FFF" class="dropdown-item" href="#">Action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Another action</a>
                        <a style="color: #FFF" class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">10468</span>
            </h4>
            <p class="text-light">Members online</p>

        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div> -->



<!--/.col-->

@endsection
