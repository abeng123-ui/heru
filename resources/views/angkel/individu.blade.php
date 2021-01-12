@extends('layouts.master')

@section('content')
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
          <h4 class="card-title ">Detail Individu <?php echo strtoupper($data->nama_lengkap) ?></h4>
          <p class="card-category"></p>
          <br>
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}">
                {!! session('message.content') !!}
                </div>
            @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" style="width: 100%; font-size: 12px">
                <tr>
                    <td width="100">NIK</td>
                    <td width="200">{{ $data->nik }}</td>
                    <td width="50">&nbsp;</td>
                    <td width="100">Alamat</td>
                    <td width="200">{{ $data->angkel->kk->alamat_kkel or '' }}</td>
                </tr>

                <tr>
                    <td>Nama</td>
                    <td><?php echo ucwords($data->nama_lengkap) ?></td>
                    <td>&nbsp;</td>
                    <td>Pekerjaan</td>
                    <td>{{ $data->klmp_pekerjaan }}</td>
                </tr>

                <tr>
                    <td>Tempat Lahir</td>
                    <td><?php echo ucwords($data->tmp_lahir) ?></td>
                    <td>&nbsp;</td>
                    <td>Kewarganegaraan</td>
                    <td>{{ $data->kewarganegaraan }}</td>
                </tr>

                <tr>
                    <td>Tanggal Lahir</td>
                    <td><?php echo $data->tgl_lahir ?></td>
                    <td>&nbsp;</td>
                    <td>Agama</td>
                    <td>{{ $data->data_agama->agama or ''}}</td>
                </tr>

                <tr>
                    <td>Jenis Kelamin</td>
                    <td><?php echo $data->jk ?></td>
                    <td>&nbsp;</td>
                    <td>Golongan Darah</td>
                    <td><?php echo $data->gol_darah ?></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><?php echo $data->email ?></td>
                    <td>&nbsp;</td>
                    <td>No Telepon</td>
                    <td><?php echo $data->no_telpn ?></td>
                </tr>

            </table>
            <br><br>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
