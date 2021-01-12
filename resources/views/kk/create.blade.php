@extends('layouts.master')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Tambah Kartu Keluarga</h4>
        </div>
        <div class="card-body">
          <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('kk/store')}}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nama Kepala Keluarga</label>
                  <input name="nama_kepala_keluarga" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Alamat Kepala Keluarga</label>
                  <input name="alamat_kkel" maxlength="200" type="text" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">RT</label>
                  <input name="rt" maxlength="5" type="numeric" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">RW</label>
                  <input name="rw" maxlength="5" type="numeric" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Kode Pos</label>
                  <input name="kodepos" maxlength="10" type="numeric" class="form-control">
                </div>
              </div>
            </div>

            <!-- <button type="submit" class="btn btn-primary pull-right">Update Profile</button> -->
            <a href="{{url('kk')}}" class="btn btn-info pull-right">Back</a>
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
        nama_kepala_keluarga: {
          required: true
        },
        alamat_kkel: {
          required: true
        },
        rt: {
          required: true
        },
        rw: {
          required: true
        },
        kodepos: {
          required: true
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
