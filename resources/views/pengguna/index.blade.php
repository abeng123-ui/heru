@extends('layouts.master')

@section('content')
<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'pengguna.list'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'head')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data User</strong>
                    <br>
                    <br>
                    <a class="btn btn-info" href="{{ url('pengguna/create') }}">Tambah User</a>
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; ?>
                            @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <th>{{ $row->name }}</th>
                                    <th>{{ $row->email }}</th>
                                    <th>{{ $row->role->role_name or ''}}</th>

                                    <th align="center">
                                      <a class="btn btn-primary" href="{{ url('pengguna/edit') }}/{{ $row->id }}">Edit</a>
                                    </th>
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
