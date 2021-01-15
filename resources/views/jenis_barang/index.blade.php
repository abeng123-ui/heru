@extends('layouts.master')

@section('content')
<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'jenis_barang.list'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'head')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Jenis Barang</strong>
                    <br>
                    <br>
                    <a class="btn btn-info" href="{{ url('jenis_barang/create') }}">Tambah Jenis Barang</a>
                    <br>
                    @if(session()->has('message.level'))
                        <div class="alert alert-{{ session('message.level') }}">
                        {!! session('message.content') !!}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="width:100%" id='bootstrap-data-table-export' class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; ?>
                            @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td>{{ $row->jenis_brg }}</td>
                                </tr>

                                <?php $x++; ?>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div><!-- .animated -->

@push('scripts')
<script type="text/javascript">
    // $(document).ready( function () {
    //     // $('#id_kopi').DataTable();
    //     var table = $('#tb_ini').DataTable({
    //      // "order": [[ 1, "desc" ]],
    //      "aLengthMenu": [10, 25, 50, 100],

    //    });

    //     $('#tb_ini tfoot th').each( function () {
    //         var title = $(this).text();
    //         $(this).html( '<input type="text" placeholder="Cari '+title+'" />' );

    //         var table = $('#tb_ini').DataTable();
    //         table.columns().every( function () {
    //         var that = this;

    //         $( 'input', this.footer() ).on( 'keyup change', function () {
    //             if ( that.search() !== this.value ) {
    //                 that
    //                     .search( this.value )
    //                     .draw();
    //                 }
    //             } );
    //         } );

    //     } );
    // });
</script>
@endpush

@else
    <h3 align="center">Maaf, Kamu tidak berhak mengakses halaman ini !</h3>
@endif

@endsection
