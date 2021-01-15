<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
<!--   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}"> -->
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> -->
  <title>
    Sistem Informasi Permintaan ATK
  </title>
  <!-- <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' /> -->
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/material-dashboard@2.1.0/assets/css/material-dashboard.css" rel="stylesheet" />

</head>
<style type="text/css">

</style>

<?php
$today = date("Y-m-d");
?>

<body style="padding: 5px">
    <div id="kk_header" style="width:100%; text-align: center ">
      <div class="col-xs-6" style="text-align: center">
        <h3 align="center">BUKTI PERMINTAAN PENGELUARAN ATK (BPP)</h3>
        <br><br>
        <h5>Pengeluaran Permintaan ATK dari Unit Pelayanan Jurusan</h5>
        <br>
          <table align="center" style="width:100%" class="table table-bordered">
              <thead class="thead-dark">
                  <tr>
                      <th scope="col">No</th>
                      <th scope="col">Kode Barang</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Satuan</th>
                      <th scope="col">Jumlah</th>

                  </tr>
              </thead>
              <tbody>
              <?php $x=1; ?>
              @foreach($permintaan as $row)
                  <tr>
                      <td scope="row">{{ $x }}</td>
                      <td>{{ $row['stokbarang']->kode_brg or '' }}</td>
                      <td>{{ $row['stokbarang']->nama_brg or '' }}</td>
                      <td>{{ $row['stokbarang']->satuan or '' }}</td>
                      <td>{{ $row->jumlah }}</td>

                  </tr>

                  <?php $x++; ?>

              @endforeach
              </tbody>
          </table>

          <br>
          <h5>Pada hari ini tanggal <b>{{ $today }}</b> telah dikeluarkan serta serah terima barang berdasarkan permintaan tanggal <b>{{ $tgl_permintaan }}</b> berupa seperti yang tersebut di atas<br>
          Kepada Bpk/Ibu <b><?php echo strtoupper($pemohon); ?></b> dari <b><?php echo strtoupper($level); ?></b> harap mengambil barang ke Rektorat Bagian Umum</h5>
        </div>

    </div>


</body>

</html>

