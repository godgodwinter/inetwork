@extends('admin.main')

@section('title','TAGIHAN LUNAS')

@section('csshere')
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    #mapCanvas {
    width: 800px;
    height: 400px;
    float: left;
  }
  #infoPanel {
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
    </style>
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css"
    href="{{ asset("admin-style/") }}/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset("admin-style/") }}/files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset("admin-style/") }}/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>
@endsection

@section('jshere')
<!-- jquerymin-->


@endsection
@section('headernav')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                    {{-- <span>Halaman Mastering @yield('title')</span> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="{{url('/dashboard')}}"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">@yield('title')</a> </li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection

@section('notif')
    @if (session('status'))
    <div class="alert alert-info border-info">
        {{ session('status') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            class="pcoded-micon"> <i class="feather icon-x-square"></i></span>
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
@endsection

@section('container')
<!-- Section start -->
<div class="page-body"id="datatable" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <a href="import" class="btn btn-sm  btn-primary" target="_blank">IMPORT</a>
                <a href="export" class="btn btn-sm  btn-primary" target="_blank">EXPORT</a>
                <a href="cetak" class="btn btn-sm  btn-primary" target="_blank">CETAK PDF</a>
            </div>
            <div class="col-xl-6 col-md-12 d-flex flex-row-reverse">
                <a href="{{url('/')}}/admin/pelanggan" class="btn btn-sm btn-secondary">PELANGGAN</a>&nbsp;
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK - Nama</th>
                            <th>Paket</th>
                            <th>Total Bayar</th>
                            <th>No WA</th>
                            <th>Tanggal Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $status_langganan='Non-Aktif';
                    @endphp
                        @foreach ($datas as $data)
                            @php

                                    if($data->status_langganan=='Aktif'){
                                        $status_langganan='Aktif';
                                    }else{
                                        $status_langganan='Non-Aktif';
                                    }

// dd($tgl);
// {{ \Carbon\Carbon::parse($user->from_date)->format('d/m/Y')}}

                            @endphp

                        <tr>
                            <td>
                                {{ ($loop->index)+1 }}

                            </td>
                            <td>{{$data->nik}} - {{$data->nama}}</td>
                            <td>
                                @php
                                //cari apakah id paket ada
                                $jmldata = DB::table('paket')
                                ->where('id', '=', $data->paket_id)
                                ->count();

                                    if (($jmldata)<1){
                                @endphp
                                <span class="pcoded-micon"> <i
                                            class="feather icon-alert-triangle"></i></span>
                                @php
                                    }else{
                                        echo $data->paket_nama." - ".$data->paket_kecepatan." Mbps";
                                    }
                                @endphp
                                </td>
                                <td>
                                    @currency($data->total_bayar)
                                </td>
                            <td>
                                @php
                                //cari apakah nik pelanggan ada
                                $jmlnik = DB::table('pelanggan')
                                ->where('nik', '=', $data->nik)
                                ->count();


                                    if (($jmldata)<1){
                                @endphp
                                <span class="pcoded-micon"> <i
                                            class="feather icon-alert-triangle"></i></span>
                                @php
                                    }else{
                                        $jmlnik = DB::table('pelanggan')
                                        ->where('nik', '=', $data->nik)->get();
                                        foreach ($jmlnik as $jn) {
                                            echo $jn->hp;
                                        }

                                    }
                                @endphp
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data->tgl_bayar)->translatedFormat('d F Y')}}
                            </td>


                            <td>

                                <form action="/admin/tagihan/{{$data->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm  btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIK - Nama</th>
                                <th>Paket</th>
                                <th>Total Bayar</th>
                                <th>No WA</th>
                                <th>Tanggal Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->

</div>
<!-- Section end -->






<!-- page body -->
@endsection
