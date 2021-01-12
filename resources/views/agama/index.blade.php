@extends('layouts.master')

@section('content')

<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'agama.index'.'%')->count();
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
          <h4 class="card-title ">Agama</h4>
          <p class="card-category"></p>
          <a class="btn btn-info" href="{{ url('agama/create') }}">Tambah Agama</a>
          <br>
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
                </div>
            @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table style="width:100%" id='tb_ini'  class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
              <thead class=" text-primary">
                <th> No </th>
                <th> Agama </th>
                <th> Aksi </th>
              </thead>

              <tbody>
              <?php $x=1; ?>
                  @foreach($data as $row)
                      <tr>
                          <th>{{ $x }}</th>
                          <th>{{ $row->agama }}</th>

                          <th align="center">
                            <a class="btn btn-primary" href="{{ url('agama/edit') }}/{{ $row->id }}">Ubah</a>
                              <a onclick="return hapus()" href="{{url('agama/delete')}}/{{$row->id}}" type="submit" class="btn btn-danger">Hapus</a>
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
