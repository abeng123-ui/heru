@extends('layouts.master')

@section('content')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Form Edit Permintaan Alat Tulis Kantor</strong>
                </div>

                <div class="card-body">
                    <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('permintaan/update')}}/{{ $data->id }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class=" form-control-label">Unit Pelayanan</label>
                            <input name="unit" type="text" value="{{ $unit }}" readonly class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Jenis Barang</label>
                            <select style="width: 350px;" class="form-control" name="id_jenis" onchange="jenisbarang(this.value)">
                                <option value="" selected="">Pilih Jenis Barang</option>
                                @foreach($jenisbarang as $row)
                                    @if($data->id_jenis == $row->id)
                                      <option selected="" value="{{ $row->id }}">{{ $row->jenis_brg }}</option>
                                    @endif
                                    <option value="{{ $row->id }}">{{ $row->jenis_brg }}</option>
                                @endforeach
                           </select>
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Nama Barang</label>
                            <select style="width: 350px;" class="form-control" name="kode_brg" onchange="kodebarang(this.value)">
                                <option value="" selected="">Pilih Nama Barang</option>
                                @foreach($stokbarang as $row)
                                    @if($data->kode_brg == $row->id)
                                      <option selected="" value="{{ $row->id }}">{{ $row->nama_brg }} - Kode:{{ $row->kode_brg }}</option>
                                    @endif
                                    <option value="{{ $row->kode_brg }}">{{ $row->nama_brg }} - Kode:{{ $row->kode_brg }}</option>
                                @endforeach
                           </select>
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Stok Tersedia</label>
                            <input value="{{ $stokbarang->sisa }}" id="sisa_brg" name="sisa" type="text" value="0" readonly class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Satuan</label>
                            <input value="{{ $stokbarang->satuan }}" id="satuan_brg" name="satuan" type="text" value="" readonly class="form-control">
                        </div>

                        <div class="form-group">
                            <label class=" form-control-label">Jumlah</label>
                            <input value="{{ $data->jumlah }}" id="jumlah_brg" name="jumlah" type="number" onchange="checkJumlah(this.value)" class="form-control">
                        </div>

                        <div class="clearfix"></div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                  </form>
                </div>
            </div>
        </div>

    </div>
</div><!-- .animated -->

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

      $('#FormIni').validate({
        rules: {
            id_jenis: {
              required: true,
            },
            kode_brg: {
              required: true,
            },
            jumlah: {
              required: true,
            },
         },

         messages: {
            // jumlah : {
            //   remote: "Jumlah sudah ada."
            // }
          },

          errorElement: "em",
          errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block alert_error" );

            if ( element.prop( "type" ) === "checkbox" ) {
              error.insertAfter( element.parent( "label" ) );
            } else {
              error.insertAfter( element );
            }
          },
          highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
          },
          unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
          }

      });

    });

    function jenisbarang(val){
      $('[name="kode_brg"]').find('option').remove();

      var newState = new Option('Pilih Nama Barang','',true,true);

      $('[name="kode_brg"]').append(newState).trigger('change');

      var jenisbarang = {!!$jenisbarang!!}

      $.each(jenisbarang,function(index,jenisbarang_data){
        if (jenisbarang_data.id == val)
        {
          var stokbarang = {!!$stokbarang!!}

          $.each(stokbarang,function(index,stokbarang_data){
            if (stokbarang_data.id_jenis == jenisbarang_data.id)
            {
              var newState = new Option(stokbarang_data.nama_brg, stokbarang_data.kode_brg, false,false);
              $('[name=kode_brg]').append(newState).trigger('change');
              $('[name=sisa]').append(stokbarang_data.sisa).trigger('change');
            }
          });

        }
      });

    }

    function kodebarang(val){
      // $('[name="sisa"]').value(0);

      var stokbarang = {!!$stokbarang!!}

      $.each(stokbarang,function(index,stokbarang_data){
        if (stokbarang_data.kode_brg == val)
        {
            $("#sisa_brg").val(stokbarang_data.sisa);
            $("#satuan_brg").val(stokbarang_data.satuan);
        }
      });

    }

    function checkJumlah(jumlah){
        var sisa = parseInt($("#sisa_brg").val());

        if(sisa < parseInt(jumlah)){
            alert("Jumlah permintaan melebihi stok !")
        }

        if(parseInt(jumlah) == 0){
            alert("Jumlah permintaan tidak boleh 0 !")
        }
    }
</script>
@endpush

@endsection
