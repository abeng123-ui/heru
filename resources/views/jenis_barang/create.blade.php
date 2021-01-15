@extends('layouts.master')

@section('content')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Tambah Jenis Barang</strong>
                </div>

                <div class="card-body">
                    <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('jenis_barang/store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class=" form-control-label">Jenis Barang</label>
                            <input name="jenis_brg" maxlength="45"  type="text" placeholder="Jenis barang" class="form-control">
                        </div>

                        <div class="clearfix"></div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                  </form>
                </div>
            </div>
        </div>

    </div>
</div><!-- .animated -->

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

      $('#FormIni').validate({
        rules: {
            jenis_brg: {
              required: true,
              remote: "check_jenis_barang"
            },
         },

         messages: {
            jenis_brg : {
              remote: "Jenis barang sudah ada."
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
