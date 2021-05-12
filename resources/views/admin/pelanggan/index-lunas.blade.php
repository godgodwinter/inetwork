@extends('admin.layouts.nav1-min')

@section('title','PELANGGAN - LUNAS')

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
{{-- @php
excel date value to php date value
  $unixDate = (44202 - 25569) * 86400;
    $convert=date("Y-m-d", $unixDate);
@endphp --}}
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-4">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                    {{-- <span>Halaman Mastering @yield('title')</span> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="page-header-title">
                <div class="d-inline">

        <form action="{{ url('/')}}/admin/pelanggan/{{ $blnthn }}/cari" method="GET">
            <input type="hidden" name="cari" value="{{ $cari }}">
            <input type="hidden" name="tagihan" value="{{ $tagihan }}">
            <input  type="month" name="blnthn" value="{{ $blnthn }}" required>


                <select name="orderby" required>
                    <option value='{{ $orderby }}'>{{ $orderby }}</option>
                     <option value='nama'>Nama</option>
                     <option value='panggilan'>Panggilan</option>
                     <option value='paket_id'>Paket</option>
                     <option value='tgl_gabung'>Tanggal Gabung</option>
                     <option value='status_langganan'>Status Langganan</option>
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
        <div class="col-lg-3">
            <div class="page-header-breadcrumb">
                <form action="{{ url('/')}}/admin/pelanggan/{{ $blnthn }}/cari" method="GET">
                    <input type="hidden" name="orderby" value="{{ $orderby }}">
                    <input type="hidden" name="tagihan" value="{{ $tagihan }}">
                    <input type="hidden" name="blnthn" value="{{ $blnthn }}">
                    <input type="hidden" name="ascdesc" value="{{ $ascdesc }}">
                    <input type="text" name="cari" placeholder="Cari .." value="{{ $cari }}">
                    <input type="submit" value="CARI">
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
    $month = date("m");
    $year = date("Y");
    $tglskrg = date("d");
@endphp
<!-- Section start -->
<div class="page-body"id="datatable" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 ml-1 mt-1">
                {{-- <a href="#add" class="btn btn-sm btn-success">BAYAR</a> --}}
                <a href="import" class="btn btn-sm  btn-primary" data-toggle="modal"
                            data-target="#import"><i class="feather icon-upload"></i>IMPORT</a>



                        <!-- Modal -->
                        <div class="modal fade" id="import" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Import File</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <span>Isi data dengan lengkap, ID Paket, Harga dll. Jika menggunakan nama paket gunakan Import Special</span>
                                        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
                                        action="{{ route('importpelanggan') }}" class="form-horizontal" method="post"
                                            enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="import_file" />

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Import File</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('exportpelanggan', 'xlsx') }}" class="btn btn-sm  btn-primary"
                        target="_blank"><i class="feather icon-download"></i>EXPORT</a>
                <a href="{{ route('pelanggan-cetakpdf') }}" class="btn btn-sm  btn-primary" target="_blank"><i class="feather icon-file-text"></i>PDF</a>
                <a href="{{ url('/')}}/admin/pelanggan-lunas" class="btn btn-sm  btn-warning"><i class="feather icon-file-text"></i>LUNAS</a>
                <a href="{{ url('/')}}/admin/pelanggan-belumlunas" class="btn btn-sm  btn-warning"><i class="feather icon-file-text"></i>BELUM LUNAS</a>
            </div>
            <div class="col-xl-12 col-md-12  col-lg-12 mt-1  ml-1">
                {{-- <div class="col-xl-12 col-md-12  col-lg-12 d-flex flex-row-reverse"> --}}
                <a href="#deleteall" class="btn btn-sm btn-danger"><i class="feather icon-x"></i> HAPUS SEMUA</a>&nbsp;
                <a href="{{ route('pelanggan.create') }}" class="btn btn-sm btn-secondary"><i class="feather icon-plus"></i>TAMBAH PELANGGAN</a>&nbsp;


            </div>

        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th  width="5%" class="text-center">Bayar Cepat</th>
                            <th>NIK - Nama</th>
                            <th>Panggilan</th>
                            <th>No WA</th>
                            <th>Tanggal Gabung</th>
                            <th class="text-center">Status Langganan</th>
                            <th class="text-center">Paket</th>
                            <th width="5%">Aksi</th>

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

//ambildata tagihandetail kurang berapa
$ambiltagihankurangberapa = DB::table('tagihan')
    ->where('nik',$data->nik)
    ->where('thbln',$blnthn)
    ->sum('total_bayar');

//periksa apakah di tabel tagihan sudah ada jika belum ambil tagihan sesuai dengan paket harga
$ambildatanikditagihan= DB::table('tagihan')
    ->where('nik',$data->nik)
    ->where('thbln',$blnthn)
            ->count();

 //JIKA $TAGIHAN=LUNAS
 if(($data->paket_harga-$ambiltagihankurangberapa)<=0){

                            @endphp
  <div class="modal fade" id="large-Modal{{ $data->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pembayaran Cepat!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
            </div>
            <div class="modal-body">

                <div class="pl-lg-4">
                    <div class="row">

                <form action="/admin/tagihan/bayarsekarang" method="post">
                    @csrf

                    @php
                        if(($data->paket_harga-$ambiltagihankurangberapa)<=0){
                            echo'<button type="Simpan" class="btn btn-success" disabled>LUNAS!</button>';
                        }else{
                    @endphp
                <div class="col-lg-6">
                    <div class="form-group">
                        <b><label class="form-control-label" for="input-nominal" id="inputnominalinternetlabel{{ $data->id }}">@currency(($data->paket_harga-$ambiltagihankurangberapa))</label></b>
                        <input type="hidden" name="nik" value="{{ $data->nik }}">
                        <input type="hidden" name="paket_id" value="{{ $data->paket_id }}">
                        <input type="hidden" name="paket_nama" value="{{ $data->paket_nama }}">
                        <input type="hidden" name="nama" value="{{ $data->nama }}">
                        <input type="hidden" name="paket_harga" value="{{ $data->paket_harga }}">
                        <input type="hidden" name="paket_kecepatan" value="{{ $data->paket_kecepatan }}">
                        <input type="hidden" name="ambiltagihankurangberapa" value="{{ $ambiltagihankurangberapa }}">
                        <input type="number" name="nominal" id="inputnominalinternet{{ $data->id }}"
                            class="form-control form-control-alternative  @error('nominal') is-invalid @enderror"
                            placeholder="Contoh : 150000" value="{{ ($data->paket_harga-$ambiltagihankurangberapa) }}" max='{{ $data->paket_harga-$ambiltagihankurangberapa }}'required>
                        @error('nominal')<div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-lg-6 mt-4">
                    <div class="form-group ">
                        <button type="Simpan" class="btn btn-success">Simpan</button>
                    </div>
                </div>
                @php
            }
                @endphp

    <script>
        var format = function(num){
        var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
        if(str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for(var j = 0, len = str.length; j < len; j++) {
            if(str[j] != ",") {
                output.push(str[j]);
                if(i%3 == 0 && j < (len - 1)) {
                    output.push(".");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return("Rp" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ",-"));
    };
        $(document).ready(function() {
        $("#inputnominalinternet{{ $data->id }}").on('keyup', function() {
            // alert("oops!");
            $('#inputnominalinternetlabel{{ $data->id }}:last').text(format($(this).val()));
        });

    });
    </script>


    </form>
</div>
</div>

    <div class="col-xl-12 col-md-12">
        <div class=" feed-card">
            <div class="card-header">
                <h5>NIK : {{ $data->nik }} - Nama : {{ $data->nama }}</h5>
            </div>
            <div class="card-block">

                <div class="row m-b-30">
                    <div class="col-auto p-r-0">
                        <i class="feather icon-file-text bg-simple-c-green feed-icon"></i>
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Harga <span class="text-muted f-right f-13">@currency($data->paket_harga)</span></h6>
                    </div>
                </div>
                <div class="row m-b-30">
                    <div class="col-auto p-r-0">
                        <i class="feather icon-file-text  bg-simple-c-blue feed-icon"></i>
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Telah dibayar <span class="text-muted f-right f-13">@currency($ambiltagihankurangberapa)</span></h6>
                    </div>
                </div>
                <div class="row m-b-30">
                    <div class="col-auto p-r-0">
                        <i class="feather icon-file-text  bg-simple-c-yellow feed-icon"></i>
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Kurang  <span class="text-muted f-right f-13 "><i class="feather icon-info label-warning"></i>@currency(($data->paket_harga-$ambiltagihankurangberapa))</span></h6>
                    </div>
                </div>

            </div>
        </div>
    </div>
            {{-- penutupmodalmain --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Kembali</button>
                {{-- <button type="button" class="btn btn-primary waves-effect waves-light ">Bayar</button> --}}
            </div>
        </div>
    </div>
</div>
                        <tr>
                            <td class="text-center">

                                @php
                        if(($data->paket_harga-$ambiltagihankurangberapa)<=0){
                            echo'<button type="Simpan" class="btn btn-success btn-sm " disabled>LUNAS!</button>';
                        }else{
                                @endphp
                                 <!-- Modal large-->
                                 <button type="button" class="btn btn-primary btn-sm waves-effect" data-toggle="modal" data-target="#large-Modal{{ $data->id }}"><span class="pcoded-micon"> <i
                                    class="feather icon-credit-card"></i></span></button>
                                @php
                            }
                                @endphp


                                {{-- {{ ($loop->index)+1 }} --}}
                                {{-- <a class="btn btn-success btn-sm btn-outline-success"
                                href="/admin/tagihan/{{$data->nik}}/bayar"><span class="pcoded-micon"> <i
                                        class="feather icon-shopping-cart"></i></span></a> --}}



                            </td>
                            <td>{{$data->nik}} - {{$data->nama}}</td>
                            <td>{{$data->panggilan}}</td>
                            <td>{{$data->hp}}</td>
                            <td>

                            @php
                            $tgl=$data->tgl_gabung;
                            if (date('Y-m-d', strtotime($tgl)) !== $tgl) {
                                @endphp
                                Tanggal tidak valid
                                @php
                            }else{
                                @endphp
                                {{ \Carbon\Carbon::parse($data->tgl_gabung)->translatedFormat('d F Y')}}

                                @php
                            }
                       @endphp

                            </td>
                            <td class="text-center">{{$status_langganan}}</td>
                            <td  class="text-center">
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
                                        echo "Paket ".$data->paket_nama." - ";
                                        @endphp
                                            @currency($data->paket_harga)
                                        @php
                                    }
                                @endphp
                            </td>

                            <td>
                                <a class="btn btn-warning btn-sm btn-outline-warning"
                                    href="/admin/pelanggan/{{$data->id}}/edit"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>
                                <form action="/admin/pelanggan/{{$data->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm  btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @php
                            }
                        @endphp
                        @endforeach
                        <tfoot>
                            <tr>
                                <th class="text-center">Bayar</th>
                                <th>NIK - Nama</th>
                                <th>Panggilan</th>
                                <th>No WA</th>
                                <th>Tanggal Gabung</th>
                                <th class="text-center">Status Langganan</th>
                                <th class="text-center">Paket</th>
                                <th>Aksi</th>
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



</div>
<!-- Section end -->






<!-- page body -->
@endsection
