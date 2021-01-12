<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
<!--   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}"> -->
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->
  <title>
    Sistem Pengelolaan Data Kelurahan Pademangan Barat
  </title>
  <!-- <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' /> -->
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/material-dashboard@2.1.0/assets/css/material-dashboard.css" rel="stylesheet" />

</head>
<style type="text/css">
  @page  {
        margin: 1cm 1cm 1cm 1cm;
    }
</style>

<body style="padding: 5px">
<?php
$data['desa'] = $desa;
$data['angkel'] = $angkel;
$data['kk'] = $kk;
?>
      <div id="kk_header" style="width:100%">
          <table cellpadding="3" style="width:100%">
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
            <table cellpadding="3" style="width:100%">
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
            <table cellpadding="3" style="width:100%" id='tb_ini' border="1">
                <tr align="center">
                  <td height="auto">No</td>
                  <td height="auto">Nama Lengkap</td>
                  <td height="auto">NIK</td>
                  <td height="auto">Jenis Kelamin</td>
                  <td height="auto">Tempat Lahir</td>
                  <td height="auto">Tanggal Lahir</td>
                  <td height="auto">Agama</td>
                  <td height="auto">Pendidikan</td>
                  <td height="auto">Jenis Pekerjaan</td>
                </tr>
                <tr style="font-size: 9px" align="center">
                  <td></td>
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
                @foreach($angkel as $row)
                <tr>
                  <td align="center" height="auto">{{ $no }}</td>
                  <td height="auto">{{ $row->penduduk->nama_lengkap or '' }}</td>
                  <td height="auto">{{ $row->penduduk->nik or '' }}</td>
                  <td height="auto">{{ $row->penduduk->jk or '' }}</td>
                  <td height="auto">{{ $row->penduduk->tmp_lahir or '' }}</td>
                  <td height="auto">{{ $row->penduduk->tgl_lahir or '' }}</td>
                  <td height="auto">{{ $row->penduduk->data_agama->agama or '' }}</td>
                  <td height="auto">{{ $row->penduduk->pendidikan_terakhir or '' }}</td>
                  <td height="auto">{{ $row->penduduk->klmp_pekerjaan or '' }}</td>
                </tr>
                <?php $no++; ?>
                @endforeach
            </table>
            <br>
            <table cellpadding="3" style="width:100%" id='tb_ini2' border="1">
                <tr align="center">
                <td height="auto" rowspan="2">No</td>
                <td height="auto" rowspan="2">Status Pernikahan</td>
                <td height="auto" rowspan="2">Status Hubungan Dalam Keluarga</td>
                <td height="auto" rowspan="2">Kewarganegaraan</td>
                <td height="auto" colspan="2">Dokumen Imigrasi</td>
                <td height="auto" colspan="2">Nama Orang Tua</td>
              </tr>
              <tr align="center">
                <td>No. Paspor</td>
                <td>No. KITAS/KITAP</td>
                <td>Ayah</td>
                <td>Ibu</td>
              </tr>
              <tr style="font-size: 9px" align="center">
                <td height="auto"></td>
                <td height="auto">(9)</td>
                <td height="auto">(10)</td>
                <td height="auto">(11)</td>
                <td height="auto">(12)</td>
                <td height="auto">(13)</td>
                <td height="auto">(14)</td>
                <td height="auto">(15)</td>
              </tr>
                <?php $no=1; $nama_ayah = '-'; $nama_ibu = '-'; ?>

                @foreach($angkel as $row)

                <?php
                $ayah = '-'; $ibu = '-';

                if(isset($row->penduduk->status_hubungan_keluarga)
                    && $row->penduduk->status_hubungan_keluarga == 'ayah'){
                    $nama_ayah = isset($row->penduduk->nama_lengkap) ? $row->penduduk->nama_lengkap : '-';
                }

                if(isset($row->penduduk->status_hubungan_keluarga)
                    && $row->penduduk->status_hubungan_keluarga == 'ibu'){
                    $nama_ibu = isset($row->penduduk->nama_lengkap) ? $row->penduduk->nama_lengkap : '-';
                }

                if(isset($row->penduduk->status_hubungan_keluarga)
                    && ($row->penduduk->status_hubungan_keluarga != 'ayah'
                    && $row->penduduk->status_hubungan_keluarga != 'ibu')) {

                    $ayah = $nama_ayah; $ibu = $nama_ibu;
                }?>
                <tr>
                  <td align="center">{{ $no }}</td>
                  <td><?php if(isset($row->penduduk->status_perkawinan) && $row->penduduk->status_perkawinan == 'kawin') {
                    echo 'Kawin'; } else { echo 'Belum Kawin'; } ?></td>
                  <td>{{ $row->penduduk->status_hubungan_keluarga or '' }}</td>
                  <td>{{ $row->penduduk->kewarganegaraan or 'WNI' }}</td>
                  <td>-</td>
                  <td>-</td>
                  <td>{{ $ayah }}</td>
                  <td>{{ $ibu }}</td>
                </tr>
                <?php $no++; ?>
                @endforeach
            </table>

          <table cellpadding="3" style="width: 100%">
            <tr>
              <td width="25%">Dikeluarkan Tanggal : <?php echo date("d-m-Y"); ?></td>
              <td width="25%">&nbsp;</td>
              <td align="center" width="25%">KEPALA KELUARGA</td>
              <td align="center" width="25%">CAMAT</td>
            </tr>
            <tr>
              <td height="70" colspan="4"></td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php echo strtoupper($kk->nama_kepala_keluarga) ?><br>Tanda Tangan/Cap Jempol</td>
              <td><b><?php echo strtoupper($desa->nama_camat) ?></b> <br> NIK. {{ $desa->nik_camat }}</td>
            </tr>

          </table>

      </div>


</body>

</html>

