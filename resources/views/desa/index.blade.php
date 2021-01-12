@extends('layouts.master')

@section('content')
<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'desa.index'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'admin')

<style type="text/css">
  tfoot {
                display: table-header-group;
            }
  select[name=tb_ini_length]{
      width: 30px
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
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Desa</h4>
          <p class="card-category"></p>
          <a class="btn btn-info" href="{{ url('desa/create') }}">Tambah Desa</a>
          <br>
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
                </div>
            @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php  if($data){ ?>
            <table style="width:100%" id='tb_ini' class="table table-striped table-bordered">
              <tr>
                  <td width="50%"> Desa </td> <td width="50%">{{ $data->desa }}</td>
              </tr>

              <tr>
                  <td> Kecamatan </td>  <td>{{ $data->kecamatan }}</td>
              </tr>

              <tr>
                  <td> Kabupaten / Kota </td>  <td>{{ $data->kabupaten }}</td>
              </tr>

              <tr>
                  <td> Provinsi </td>  <td>{{ $data->provinsi }}</td>
              </tr>

              <tr>
                  <td> Kepala Desa </td>  <td>{{ $data->kepala_desa }}</td>
              </tr>

              <tr>
                  <td> Kepala Camat </td>  <td>{{ $data->nama_camat }}</td>
              </tr>

              <tr>
                  <td> NIK Camat </td>  <td>{{ $data->nik_camat }}</td>
              </tr>

              <tr>
                  <td align="right" colspan="5">
                    <a class="btn btn-primary" href="{{ url('desa/edit') }}/{{ $data->id }}">Ubah</a>
                      <a onclick="return hapus()" href="{{url('desa/delete')}}/{{$data->id}}" type="submit" class="btn btn-danger">Hapus</a>
                  </td>
              </tr>
            </table>
          <?php }else{ ?>
            <br>
          <p align="center">Data desa belum ada</p>
          <?php } ?>

            <br><br>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready( function () {
        // $('#id_kopi').DataTable();
        var table = $('#tb_ini').DataTable({
         // "order": [[ 1, "desc" ]],
         "aLengthMenu": [10, 25, 50, 100],

       });

        $('#tb_ini tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Cari '+title+'" />' );

            var table = $('#tb_ini').DataTable();
            table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                    }
                } );
            } );

        } );
    });
</script>
@endpush

@else
    <h3 align="center">Maaf, Kamu tidak berhak mengakses halaman ini !</h3>
@endif


@endsection
