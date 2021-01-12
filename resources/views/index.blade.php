@extends('layouts.master')

@section('content')
<style type="text/css">
  tfoot {
                display: table-header-group;
            }
</style>
<script type="text/javascript">
function hapus()
    {
       var x = confirm("Yakin ingin menghapus ?");
       if(x)
        { return true; }
      else { return false; }

    }
</script>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
          <div class="card-icon">
            <i class="material-icons">content_copy</i>
          </div>
          <p class="card-category">Jumlah KK</p>
          <h3 class="card-title">{{ $jumlah_kk }}
            <!-- <small>GB</small> -->
          </h3>
        </div>
        <br>
        <!-- <div class="card-footer"> -->
          <!-- <div class="stats">
            <i class="material-icons text-danger">warning</i>
            <a href="javascript:;">Get More Space...</a>
          </div> -->
        <!-- </div> -->
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
          <div class="card-icon">
            <i class="material-icons">store</i>
          </div>
          <p class="card-category">Jumlah Penduduk</p>
          <h3 class="card-title">{{ $jumlah_penduduk }}</h3>
        </div>
        <br>
        <!-- <div class="card-footer">
          <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-danger card-header-icon">
          <div class="card-icon">
            <i class="material-icons">info_outline</i>
          </div>
          <p class="card-category">Jumlah Warga Baru Bulan Ini</p>
          <h3 class="card-title">{{ $warga_baru_this_month }}</h3>
        </div>
        <br>
        <!-- <div class="card-footer">
          <div class="stats">
            <i class="material-icons">local_offer</i> Tracked from Github
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-header card-header-info card-header-icon">
          <div class="card-icon">
            <i class="fa fa-twitter"></i>
          </div>
          <p class="card-category">Jumlah Penduduk Usia Produktif</p>
          <h3 class="card-title">{{ $usia_produktif }}</h3>
        </div>
        <br>
        <!-- <div class="card-footer">
          <div class="stats">
            <i class="material-icons">update</i> Just Updated
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
@endsection
