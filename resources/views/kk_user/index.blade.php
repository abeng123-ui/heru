@extends('layouts.master')

@section('content')

<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'kk_user.index'.'%')->count();
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
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table style="width:100%">
              <tr>
                <td width="30%">
                  <img src="{{ asset('images/garuda.png') }}" style="max-width: 100px;height: auto">
                </td>
                <td width="40%">
                  <h3 align="center"><b>KARTU KELUARGA</b></h3>
                   <h5 align="center"><b>No. {{ $kk->no_kk }}</b></h5>
                </td>
                <td width="30%">
                  &nbsp;
                </td>
              </tr>

            </table>
            <table style="width:100%">
              <tr>
                <td>Nama Kepala Keluarga</td>
                <td>: {{ $kk->nama_kepala_keluarga }}</td>
                <td width="30%">&nbsp;</td>
                <td>Kecamatan</td>
                <td>: {{ $desa->kecamatan }}</td>
              </tr>

              <tr>
                <td>Alamat</td>
                <td>: {{ $kk->alamat_kkel }}</td>
                <td width="30%">&nbsp;</td>
                <td>Kabupaten/Kota</td>
                <td>: {{ $desa->kabupaten }}</td>
              </tr>

              <tr>
                <td>RT/RW</td>
                <td>: {{ $kk->rt }}/{{ $kk->rw }}</td>
                <td width="30%">&nbsp;</td>
                <td>Kode Pos</td>
                <td>: {{ $kk->kodepos }}</td>
              </tr>

              <tr>
                <td>Desa/Kelurahan</td>
                <td>: {{ $desa->desa }}</td>
                <td width="30%">&nbsp;</td>
                <td>Provinsi</td>
                <td>: {{ $desa->provinsi }}</td>
              </tr>
            </table>
            <br>
            <table style="width:100%" id='tb_ini' border="1">
                <tr align="center">
                  <td>No</td>
                  <td>Nama Lengkap</td>
                  <td>NIK</td>
                  <td>Jenis Kelamin</td>
                  <td>Tempat Lahir</td>
                  <td>Tanggal Lahir</td>
                  <td>Agama</td>
                  <td>Pendidikan</td>
                  <td>Jenis Pekerjaan</td>
                </tr>
                <tr align="center">
                  <td height="20"></td>
                  <td>(1)</td>
                  <td>(2)</td>
                  <td>(3)</td>
                  <td>(4)</td>
                  <td>(5)</td>
                  <td>(6)</td>
                  <td>(7)</td>
                  <td>(8)</td>
                </tr>
                <?php $no=1; ?>
                @foreach($data as $row)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $row->penduduk->nama_lengkap or '' }}</td>
                  <td>{{ $row->penduduk->nik or '' }}</td>
                  <td>{{ $row->penduduk->jk or '' }}</td>
                  <td>{{ $row->penduduk->tmp_lahir or '' }}</td>
                  <td>{{ $row->penduduk->tgl_lahir or '' }}</td>
                  <td>{{ $row->penduduk->data_agama->agama or '' }}</td>
                  <td>{{ $row->penduduk->pendidikan_terakhir or '' }}</td>
                  <td>{{ $row->penduduk->klmp_pekerjaan or '' }}</td>
                </tr>
                <?php $no++; ?>
                @endforeach
            </table>
            <br>
            <table style="width:100%" id='tb_ini2' border="1">
                <tr align="center">
                  <td>No</td>
                  <td>Status Pernikahan</td>
                  <td>Status Hubungan Dalam Keluarga</td>
                  <td>Kewarganegaraan</td>
                </tr>
                <tr align="center">
                  <td></td>
                  <td>(9)</td>
                  <td>(10)</td>
                  <td>(11)</td>
                </tr>
                <?php $no=1; ?>
                @foreach($data as $row)
                <tr>
                  <td>{{ $no }}</td>
                  <td><?php if(isset($row->penduduk->status_perkawinan) && $row->penduduk->status_perkawinan == 'kawin') {
                    echo 'Kawin'; } else { echo 'Belum Kawin'; } ?></td>
                  <td>{{ $row->penduduk->status_hubungan_keluarga or '' }}</td>
                  <td>{{ $row->penduduk->kewarganegaraan or 'WNI' }}</td>
                </tr>
                <?php $no++; ?>
                @endforeach
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
