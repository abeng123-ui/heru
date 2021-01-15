@extends('layouts.master')

@section('content')
<?php
$acl = \App\Models\Role::where('id', \Auth::user()->role_id)->where('route_access_list', 'LIKE', '%'.'permintaan.jurusan.cetak_bpp'.'%')->count();
$admin = \App\Models\Role::find(\Auth::user()->role_id)->role_code;
?>
@if($acl != 0 || $admin == 'admin')

<div class="animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Cetak Bukti Pengeluaran Permintaan</strong>
                    <br>
                    @if(session()->has('message.level'))
                        <div class="alert alert-{{ session('message.level') }}">
                        {!! session('message.content') !!}
                        </div>
                    @endif
                </div>

                <div class="card-body">
                    <form id="FormIni" method="POST" enctype="multipart/form-data" action="{{url('download')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class=" form-control-label">Pilih Tanggal Permintaan</label>
                            <br>
                            <select style="width: 350px;" class="form-control js-example-basic-single" name="tgl_permintaan">
                                <option value="" selected="">Pilih Tanggal Permintaan</option>
                                @foreach($data as $row)
                                    <option selected="" value="{{ $row->tgl_permintaan }}">{{ $row->tgl_permintaan }}</option>
                                @endforeach
                           </select>
                        </div>

                        <div class="clearfix"></div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Cetak
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
    $('.js-example-basic-single').select2();

    jQuery(document).ready(function () {
      'use strict';

      jQuery('#filter-date, #search-from-date, #search-to-date').datetimepicker();
  });
</script>
@endpush

@else
    <h3 align="center">Maaf, Kamu tidak berhak mengakses halaman ini !</h3>
@endif

@endsection
