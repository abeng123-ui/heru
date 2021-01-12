@extends('layouts.master')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Ubah Kategori</h4>
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
                </div>
            @endif

        </div>
        <div class="card-body">
          <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('kategori/update')}}/{{ $data->id }}">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Kategori</label>
                  <input value="{{ $data->kategori }}" name="kategori" maxlength="45" type="text" class="form-control">
                </div>
              </div>
            </div>

            <!-- <button type="submit" class="btn btn-primary pull-right">Update Profile</button> -->
            <a href="{{url('kategori')}}" class="btn btn-info pull-right">Back</a>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
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
        kategori: {
          required: true,
        }
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
