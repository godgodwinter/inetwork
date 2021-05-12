@extends('admin.layouts.nav1-min')

@section('title','TAGIHAN')

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
        <div class="col-lg-4">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title') BULAN
 {{ strtoupper(\Carbon\Carbon::parse($blnthn)->translatedFormat('F Y')) }}
                    </h4>
                    {{-- <span>Halaman Mastering @yield('title')</span> --}}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="page-header-title">
                <div class="d-inline">

                    <form action="{{ url('/')}}/admin/tagihan/{{ $blnthn }}/cari" method="GET">
                        <input type="hidden" name="cari" value="{{ $cari }}">
                        <input type="hidden" name="tagihan" value="{{ $tagihan }}">
                        <input  type="month" name="blnthn" value="{{ $blnthn }}" required>
                    <select name="orderby" required>
                        <option value='{{ $orderby }}'>{{ $orderby }}</option>
                            <option value='nama'>Nama</option>
                            <option value='paket_id'>Paket</option>
                            <option value='tgl_bayar'>Tanggal Bayar</option>
                    </select>
                    <select name="ascdesc" required>
                        <option value='{{ $ascdesc }}'>{{ $ascdesc }}</option>
                            <option value='asc'>ASC</option>
                            <option value='desc'>Desc</option>
                    </select>
                     <button type="Simpan" class="btn btn-success">PILIH</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <form action="{{ url('/')}}/admin/tagihan/{{ $blnthn }}/cari" method="GET">
                    <input type="hidden" name="orderby" value="{{ $orderby }}">
                    <input type="hidden" name="tagihan" value="{{ $tagihan }}">
                    <input type="hidden" name="blnthn" value="{{ $blnthn }}">
                    <input type="hidden" name="ascdesc" value="{{ $ascdesc }}">
                    <input type="text" name="cari" placeholder="Cari .." value="{{ $cari }}">
                    <input type="submit"  class="btn btn-success btn-sm" value="CARI">
                </form>
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

@php
    $list=array();
$month = date("m",strtotime($blnthn));
$year = date("Y",strtotime($blnthn));
$tglskrg = date("d");
$pelanggan_lunas=0;

// //ambildata tagihandetail kurang berapa
// $ambiltagihankurangberapa = DB::table('tagihandetail')
//     ->where('nik',$data->nik)
//     ->where('thbln',$blnthn)
//     ->sum('bayar');

//ambil data pelanggan status langgan aktif
$ambildatapelangganaktif = DB::table('pelanggan')
        ->where('status_langganan', '=', 'Aktif')
        ->count();

//ambil data pelanggan status langgan aktif
$ambildatapelangganaktifget = DB::table('pelanggan')
        ->where('status_langganan', '=', 'Aktif')
        ->get();

        //total tagihan bulan ini
        $ambiltotaltagihanbulanini = DB::table('tagihan')
    ->where('thbln',$blnthn)
    ->sum('paket_harga');

foreach ($ambildatapelangganaktifget as $da) {
    //ambiljumlahbayar di tagihan detail per nik thbln
    $ambiltagihankurangberapa = DB::table('tagihandetail')
    ->where('nik',$da->nik)
    ->where('thbln',$blnthn)
    ->sum('bayar');

    // dd($da->nik);
    // $ambildatalunas = DB::table('tagihan')
    //     ->where('nik', '=', $da->nik)
    //     ->where('paket_harga', '=', $ambiltagihankurangberapa)
    //     ->where('thbln',$blnthn)
    //     ->count();

    //ambil paket harga di tagihan dibandingkan dengan bayar di detailtagihan

//ambil data pelanggan status langgan aktif
$ambildatatagihanpaketharga = DB::table('tagihan')
    ->where('nik',$da->nik)
    ->where('thbln',$blnthn)
        ->get();

$cekdataambildatatagihanpaketharga = DB::table('tagihan')
    ->where('nik',$da->nik)
    ->where('thbln',$blnthn)
        ->count();

        $datapharga=0;
foreach ($ambildatatagihanpaketharga as $datapaketharga) {
    $datapharga=$datapaketharga->paket_harga;
}


// dd($da->nik."-".$ambiltagihankurangberapa."-".$ambildatalunas);
if($cekdataambildatatagihanpaketharga!=0){
        if($ambiltagihankurangberapa>=$datapharga){
            $pelanggan_lunas+=1;
        }
    }


}


    //jumlah pelanggan yang telah membayar
    $ambiljmlhpembayar = DB::table('tagihandetail')
        ->whereMonth('created_at', '=', date("m",strtotime($blnthn)))
        ->whereYear('created_at', '=', date("Y",strtotime($blnthn)))
        ->count();

    //Total pemasukan dari  internet
    $ambiltotalinternetbulanini = DB::table('tagihandetail')
        ->where('thbln', '=', $blnthn)
        ->sum('bayar');
        // dd($ambiljmlhpembayar);

    //Total pemasukan dari  internet jika semua terbayar
    $ambiltotalyangdidapatjikasmuaterbayar= DB::table('tagihan')
        ->where('thbln', '=', $blnthn)
        ->sum('paket_harga');

                // dd($ambiljmlhpembayar)
@endphp

<div class="page-body">
    <div class="row">

<!-- customar project  start -->
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-block">
            <div class="row align-items-center m-l-0">
                <div class="col-auto">
                    <h6 class="text-muted m-b-10">TOTAL TAGIHAN</h6>
                    <h5 class="m-b-0 text-c-blue">@currency($ambiltotaltagihanbulanini)</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-block">
            <div class="row align-items-center m-l-0">
                <div class="col-auto">
                    <h6 class="text-muted m-b-10">LUNAS</h6>
                    <h5 class="m-b-0 text-c-green">{{ $pelanggan_lunas }} Pelanggan - @currency($ambiltotalinternetbulanini)</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-block">
            <div class="row align-items-center m-l-0">
                <div class="col-auto">
                    <h6 class="text-muted m-b-10">BELUM LUNAS</h6>
                    <h5 class="m-b-0 text-c-pink">{{ $ambildatapelangganaktif-$pelanggan_lunas }} Pelanggan - @currency($ambiltotalyangdidapatjikasmuaterbayar-$ambiltotalinternetbulanini)</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- customar project  end -->
</div>
</div>

<!-- Section start -->
<div class="page-body"id="datatable" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="row">
            <div class="col-xl-12 col-md-12 mt-1 ml-1">
                <a href="import" class="btn btn-sm  btn-primary" target="_blank"><i class="feather icon-upload"></i>IMPORT</a>
                <a href="export" class="btn btn-sm  btn-primary" target="_blank"><i class="feather icon-download"></i>EXPORT</a>
                <a href="{{ url('/')}}/admin/cetak/cetak_tagihan" class="btn btn-sm  btn-primary" target="_blank"><i class="feather icon-file-text"></i>PDF</a>
                <a href="{{ url('/')}}/admin/cetak/{{ $blnthn }}/tagihan-bulanini/" class="btn btn-sm  btn-primary" target="_blank"><i class="feather icon-moon"></i>PDF BULAN INI</a>

                <a href="{{ url('/')}}/admin/tagihan-lunas" class="btn btn-sm  btn-warning"><i class="feather icon-file-text"></i>LUNAS</a>
                <a href="{{ url('/')}}/admin/tagihan-belumlunas" class="btn btn-sm  btn-warning"><i class="feather icon-file-text"></i>BELUM LUNAS</a>

            </div>
            <div class="col-xl-12 col-md-12 mt-1 ml-1">

                <form action="{{ route('tagihan.sync') }}" method="post" class="d-inline">
                    @csrf
                    <input  type="hidden" name="blnthn" value="{{ $blnthn }}" required>
                    <button type="Simpan" class="btn btn-primary btb-sm"><i class="feather icon-refresh-cw"></i>SYNC</button>
                    </form>&nbsp;
                <a href="{{url('/')}}/admin/pelanggan" class="btn btn-sm btn-secondary"><i class="feather icon-briefcase"></i>PELANGGAN</a>&nbsp;

            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="5%" class="text-center">Status</th>
                            <th>NIK - Nama</th>
                            <th>Paket</th>
                            <th>Total Bayar</th>
                            <th>Tagihan</th>
                            <th>No WA</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $status_langganan='Non-Aktif';
                    @endphp
                        @foreach ($datas as $data)
                            @php

                                    // if($data->status_langganan=='Aktif'){
                                    //     $status_langganan='Aktif';
                                    // }else{
                                    //     $status_langganan='Non-Aktif';
                                    // }

// dd($tgl);
// {{ \Carbon\Carbon::parse($user->from_date)->format('d/m/Y')}}

                            @endphp

                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td class="text-center">
                        @php
                            if(($data->paket_harga-$data->total_bayar)<=0){
                        @endphp
                                        <a class="btn btn-success btn-sm  btn-outline-success" href="{{url('/')}}/admin/tagihan/{{ $data->id }}/detail"><span
                                                class="pcoded-micon"> <i class="feather icon-zoom-in"></i></span> LUNAS</a>
                        @php

                            }else{
                        @endphp
                                       <a class="btn btn-warning btn-sm  btn-outline-warning" href="{{url('/')}}/admin/tagihan/{{ $data->id }}/detail"><span
                                class="pcoded-micon"> <i class="feather icon-zoom-in"></i></span> Detail</a>
                        @php
                            }
                        @endphp

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
                                    @currency($data->paket_harga)
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



                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th width="5%" class="text-center">Status</th>
                                <th>NIK - Nama</th>
                                <th>Paket</th>
                                <th>Total Bayar</th>
                                <th>Tagihan</th>
                                <th>No WA</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </tfoot>
                </table>

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {!! $datas->links() !!}
    </div>

    <br/>
    Halaman : {{ $datas->currentPage() }} <br/>
    Jumlah Data : {{ $datas->total() }} <br/>
    Data Per Halaman : {{ $datas->perPage() }} <br/>
    Urutan Berdasarkan : {{ $orderby }} - {{ $ascdesc }} <br/>
    Status Pembayaran : {{ $tagihan }} <br/>
    Halaman di muat dalam {{ number_format((microtime(true) - LARAVEL_START),2) }} detik.
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->

</div>
<!-- Section end -->






<!-- page body -->
@endsection
