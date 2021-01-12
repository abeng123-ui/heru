@extends('layouts.master')

@section('content')

<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'kk.index'.'%')->count();
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
          <h4 class="card-title ">Kartu Keluarga</h4>
          <p class="card-category"></p>
          <a class="btn btn-info" href="{{ url('kk/create') }}">Tambah Kartu Keluarga</a>
          <br>
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
                </div>
            @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table style="width:100%" id='tb_ini' class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
              <thead class=" text-primary" style="font-size:12px">
                <th> No </th>
                <th> No KK </th>
                <th> RT </th>
                <th> RW </th>
                <th> Jumlah Individu </th>
                <th> Nama Kepala Keluarga </th>
                <th> Aksi </th>
              </thead>

              <tbody>
              <?php $x=1; ?>
                  @foreach($data as $row)
                      <tr>
                          <th>{{ $x }}</th>
                          <th><a href="{{ url('angkel') }}/{{ $row->no_kk }}">{{ $row->no_kk }}</a></th>
                          <th>{{ $row->rt }}</th>
                          <th>{{ $row->rw }}</th>
                          <th><?php echo count($row->angkel) ?></th>
                          <th>{{ $row->nama_kepala_keluarga }}</th>

                          <th align="center">
                            <a class="btn btn-primary" href="{{ url('kk/edit') }}/{{ $row->id }}">Ubah</a>
                              <a onclick="return hapus()" href="{{url('kk/delete')}}/{{$row->id}}" type="submit" class="btn btn-danger">Hapus</a>
                          </th>

                      </tr>
                      <?php $x++; ?>
                  @endforeach
              </tbody>
            </table>

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
