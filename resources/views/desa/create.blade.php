@extends('layouts.master')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Tambah Desa</h4>
        </div>
        <div class="card-body">
          <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('desa/store')}}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Desa</label>
                  <input name="desa" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Kecamatan</label>
                  <input name="kecamatan" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Kabupaten</label>
                  <input name="kabupaten" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Provinsi</label>
                  <input name="provinsi" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Kepala Desa</label>
                  <input name="kepala_desa" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Kepala Camat</label>
                  <input name="nama_camat" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">NIK Kepala Camat</label>
                  <input name="nik_camat" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <!-- <button type="submit" class="btn btn-primary pull-right">Update Profile</button> -->
            <a href="{{url('desa')}}" class="btn btn-info pull-right">Back</a>
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

  $('#FormIni').validate({
    rules: {
        desa: {
          required: true,
        },
        kecamatan: {
          required: true,
        },
        kabupaten: {
          required: true,
        },
        provinsi: {
          required: true,
        },
        kepala_desa: {
          required: true,
        },
        nama_camat: {
          required: true,
        },
        nik_camat: {
          required: true,
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
</script>

@endpush

@endsection
