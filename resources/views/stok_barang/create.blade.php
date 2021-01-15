@extends('layouts.master')

@section('content')

<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'stok_barang.create'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'head')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Tambah Stok Barang / Pemasukan</strong>
                </div>

                <div class="card-body">
                    <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('stok_barang/store')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class=" form-control-label">Jenis Barang</label>
                            <select class="form-control" name="id_jenis">
                            @foreach($jenisbarang as $row)
                                <option value="{{ $row->id }}">{{ $row->jenis_brg }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Nama Barang</label>
                            <input name="nama_brg" maxlength="45"  type="text" placeholder="Nama barang" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Satuan</label>
                            <select class="form-control" name="satuan">
                              <option value="pcs">Pcs</option>
                              <option value="pack">Pack</option>
                              <option value="dus">Dus</option>
                              <option value="batang">Batang</option>
                              <option value="rim">Rim</option>
                              <option value="kodi">Kodi</option>
                              <option value="botol">Botol</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Jumlah</label>
                            <input onchange="checkJumlah(this.value)" name="jumlah" maxlength="10"  type="number" placeholder="Jumlah" class="form-control">
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
            nama_brg: {
              required: true,
              remote: "check_stok_barang"
            },
            satuan: {
              required: true,
            },
            jumlah: {
              required: true,
            },
            id_jenis: {
              required: true,
            },
         },

         messages: {
            nama_brg : {
              remote: "Nama barang sudah ada."
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

    function checkJumlah(jumlah){
        if(parseInt(jumlah) == 0){
            alert("Jumlah stok tidak boleh 0 !")
        }
    }


</script>
@endpush

@else
    <h3 align="center">Maaf, Kamu tidak berhak mengakses halaman ini !</h3>
@endif

@endsection
