@extends('layouts.master')

@section('content')

<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'pengguna.create'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'head')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Tambah Data User</strong>
                </div>

                <div class="card-body">
                    <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('pengguna/store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class=" form-control-label">Nama</label>
                            <input name="name" maxlength="45"  type="text" placeholder="Nama Anda" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Email</label>
                            <input name="email" maxlength="45"  type="email" placeholder="Email Anda" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Password</label>
                            <input name="password" maxlength="45"  type="password" placeholder="Password Anda" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Konfirmasi Password</label>
                            <input name="password_confirm" maxlength="45"  type="password" placeholder="Password Anda" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Level</label>
                            <select class="form-control" name="role_id">
                            @foreach($data_role as $row)
                                <option value="{{ $row->id }}">{{ $row->role_name }}</option>
                            @endforeach
                            </select>
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
            email: {
              required: true,
              remote: "check_pengguna"
            },
            name: {
              required: true,
            },
            password: {
              required: true,
            },
            password_confirm: {
              required: true,
            },
            role_id: {
              required: true,
            },
         },

         messages: {
            email : {
              remote: "Email sudah ada."
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

@else
    <h3 align="center">Maaf, Kamu tidak berhak mengakses halaman ini !</h3>
@endif

@endsection
