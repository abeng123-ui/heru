@extends('layouts.master')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Tambah Penduduk</h4>
        </div>
        <div class="card-body">
          <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('penduduk/store')}}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Kartu Keluarga</label>
                  <select name="no_kk" class="form-control js-example-basic-single">
                      <option selected="">Pilih KK</option>
                      <?php foreach ($kk as $key) { ?>
                      <option value="{{ $key->no_kk }}">{{ $key->no_kk }} - {{ $key->nama_kepala_keluarga }} - {{ substr($key->alamat_kkel, 0, 50) }}</option>
                      <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Lengkap</label>
                  <input name="nama_lengkap" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Tempat Lahir</label>
                  <input name="tmp_lahir" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Tanggal Lahir</label>
                  <input id="filter-date" name="tgl_lahir" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Jenis Kelamin</label>
                  <select name="jk" class="form-control">
                      <option value="L">Laki-Laki</option>
                      <option value="P">Perempuan</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Golongan Darah</label>
                  <select name="gol_darah" class="form-control">
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="O">O</option>
                      <option value="AB">AB</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Agama</label>
                  <select name="agama" class="form-control">
                      <?php foreach ($agama as $key) { ?>
                      <option value="{{ $key->id }}">{{ $key->agama }}</option>
                      <?php } ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Pendidikan Terakhir</label>
                  <select name="pendidikan_terakhir" class="form-control">
                      <option value="sd">SD</option>
                      <option value="smp">SMP</option>
                      <option value="sma">SMA</option>
                      <option value="diploma">Diploma</option>
                      <option value="sarjana">Sarjana</option>
                      <option value="lainnya">Lainnya</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Status Hubungan Keluarga</label>
                  <select name="status_hubungan_keluarga" class="form-control">
                      <option value="ayah">Ayah</option>
                      <option value="ibu">Ibu</option>
                      <option value="anak">Anak</option>
                      <option value="lainnya">Lainnya</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Pekerjaan</label>
                  <input name="klmp_pekerjaan" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Status Perkawinan</label>
                   <select name="status_perkawinan" class="form-control">
                      <option value="belum_kawin">Belum Kawin</option>
                      <option value="kawin">Kawin</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">No Telepon</label>
                  <input name="no_telpn" maxlength="45" type="numeric" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Email</label>
                  <input name="email" maxlength="45" type="email" class="form-control">
                </div>
              </div>
            </div>

            <!-- <button type="submit" class="btn btn-primary pull-right">Update Profile</button> -->
            <a href="{{url('penduduk')}}" class="btn btn-info pull-right">Back</a>
            <button type="submit" class="btn btn-primary pull-right">Save</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>

@push('scripts')

<script type="text/javascript">
$(document).ready(function() {

  $('.js-example-basic-single').select2();

  $('#FormIni').validate({
    rules: {
        no_kk: {
          required: true
        },
        nama_lengkap: {
          required: true
        },
        tgl_lahir: {
          required: true
        },
        tmp_lahir: {
          required: true
        },
        jk: {
          required: true
        },
        gol_darah: {
          required: true
        },
        alamat: {
          required: true
        },
        agama: {
          required: true
        },
        pendidikan_terakhir: {
          required: true
        },
        status_hubungan_keluarga: {
          required: true
        },
        klmp_pekerjaan: {
          required: true
        },
        status_perkawinan: {
          required: true
        },
        no_telpn: {
          required: true,
          number:true
        },
     },

      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass( "help-block alert_error" );

        if ( element.prop( "type" ) === "checkbox" ) {
          error.insertAfter( element.parent( "label" ) );
        } else {
          error.insertAfter( element );
        }
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
      },
      unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
      }

  });

});

jQuery(document).ready(function () {
      'use strict';

      jQuery('#filter-date, #search-from-date, #search-to-date').datetimepicker();
  });
</script>

@endpush

@endsection
