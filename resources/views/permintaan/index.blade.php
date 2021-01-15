@extends('layouts.master')

@section('content')
<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'permintaan.list'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'head')

<script type="text/javascript">
function setuju()
    {
       var x = confirm("Anda yakin ingin menyetujui permintaan ?");
       if(x)
        { return true; }
      else { return false; }

    }

function tidak()
    {
       var x = confirm("Anda yakin ingin menolak permintaan ?");
       if(x)
        { return true; }
      else { return false; }

    }
</script>

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Data Permintaan</strong>
                    <br>
                    <br>
                    <?php
                    $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'permintaan.create'.'%')->count();
                    $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
                    ?>
                    @if($acl != 0)
                        <a class="btn btn-info" href="{{ url('permintaan/create') }}">Tambah Permintaan</a>
                        <br>
                        @if(session()->has('message.level'))
                            <div class="alert alert-{{ session('message.level') }}">
                            {!! session('message.content') !!}
                            </div>
                        @endif
                    @endif

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table style="width:100%" id='bootstrap-data-table-export' class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Nama Pemohon</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; ?>
                            @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{ $x }}</th>
                                    <td>{{ $row->stokbarang->nama_brg or '' }}</td>
                                    <td>{{ $row->jumlah }}</td>
                                    <td>{{ $row->stokbarang->satuan or '' }}</td>
                                    <td>{{ $row->nama_pemohon }}</td>
                                    <td>
                                        @if($row->status == 1)
                                            <button class="btn btn-success btn-sm">Sudah disetujui</button>
                                        @elseif($row->status == 2)
                                            <button class="btn btn-danger btn-sm">Ditolak</button>
                                        @else

                                            <button class="btn btn-info btn-sm">Menunggu persetujuan</button>
                                        @endif
                                    </td>
                                    <td align="center">
                                        <!-- ubah hanya boleh jika status belum diverifikasi -->
                                        @if($row->status == 0)
                                        <?php
                                            $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'permintaan.setuju'.'%')->count();
                                            $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
                                            ?>
                                            @if($acl != 0)
                                                <a onclick="return setuju()" type="submit" class="btn btn-primary" href="{{url('permintaan/setuju')}}/{{$row->id}}">Setuju</a>
                                            @endif

                                            <?php
                                            $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'permintaan.tidak_setuju'.'%')->count();
                                            $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
                                            ?>
                                            @if($acl != 0)
                                                <a onclick="return tidak()" type="submit" class="btn btn-danger" href="{{url('permintaan/tidak')}}/{{$row->id}}">Tidak</a>
                                            @endif

                                            <!-- <?php
                                            $acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'permintaan.edit'.'%')->count();
                                            $admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
                                            ?>
                                            @if($acl != 0)
                                                <a class="btn btn-info" href="">Edit</a>
                                            @endif -->
                                        @endif
                                    </td>
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
