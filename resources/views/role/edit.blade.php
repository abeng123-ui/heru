@extends('layouts.master')

@section('content')

<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'role.edit'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'admin')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Edit Data Hak Akses User</strong>
                </div>

                <div class="card-body">
                    <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('role/update')}}/{{ $data->id }}">
                        {{ csrf_field() }}

                        <table class="table">

                        <tr>
                          <td width="20%">Kode Akses </td>
                          <td>
                            <input value="{{ $data->role_code }}" readonly="readonly" style="width: 200px;" type="text" name="role_code" class="form-control">
                          </td>
                        </tr>

                        <tr>
                          <td>Nama Akses</td>
                          <td>
                            <input value="{{ $data->role_name }}" style="width: 200px;" type="text" name="role_name" class="form-control">
                          </td>
                        </tr>

                        <tr>
                          <td>Informasi Akses</td>
                          <td>
                            <?php
                              $routeCollection = Route::getRoutes();
                              $new             = [];
                              $groups          = [];
                              foreach ($routeCollection as $value) {

                                  if(($value->getName() != '') or (!$value)){

                                      if(strpos($value->getName(), 'front-user') === false){

                                          if (in_array(explode(".",$value->getName())[0], $groups)) {

                                          } else {

                                              array_push($groups, explode(".",$value->getName())[0]);
                                          }
                                          array_push($new, $value->getName());
                                      }
                                  }
                              }
                              asort($groups);
                              foreach ($groups as $key => $group) {
                                  if(!in_array($group, ['login', 'logout', 'password', 'register'])){
                                      # code...
                                      echo '<label class="switch"><input type="checkbox" class="skip" onclick="checkclass(\''.$group.'\')" id="'.$group.'"/><span></span><em> '.$group.'</em> </label></br>';
                                      foreach ($routeCollection as $row) {
                                          if(explode(".",$row->getName())[0] == $group){

                                              echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="switch" style="margin-left:25px;"><input type="checkbox" id="as'.str_replace(".","bb",$row->getName()).'" name="routelist[]" class="'.$group.' skip" value="'.$row->getName().'"/><span></span> '.$row->getName().'</label></br>';
                                          }
                                      }
                                      echo '</br>';
                                  }
                              }

                          ?>
                          </td>
                        </tr>

                        <tr>
                          <td></td>
                          <td><br>
                              <button type="submit" class="btn btn-primary">Save</button>
                              <a href="{{url('role')}}" class="btn btn-info">Back</a>
                          </td>

                        </tr>

                      </table>

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
            role_code: {
              required: true,
            },
            role_name: {
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

function checkclass(data)
    {
        if($( "#"+data ).is(':checked'))
        {
            $( "."+data ).not(this).prop( "checked", true );
        }
        else
        {
            $( "."+data ).not(this).prop( "checked", false );
        }

    }

  @foreach (json_decode($data->route_access_list)->routelist as $listcheck)
        $( '#as{{str_replace(".","bb",$listcheck)}}' ).not(this).prop( "checked", true );
    @endforeach

</script>
@endpush

@else
    <h3 align="center">Maaf, Kamu tidak berhak mengakses halaman ini !</h3>
@endif

@endsection
