@extends('admin.layouts.nav1')

@section('title','PELANGGAN')

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

@php
    $blnthn=date("Y-m");
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
            <div class="col-xl-6 col-md-6">
                {{-- <a href="#add" class="btn btn-sm btn-success">BAYAR</a> --}}
                <a href="import" class="btn btn-sm  btn-primary" data-toggle="modal"
                            data-target="#import">IMPORT</a>



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
                        target="_blank">EXPORT</a>
                <a href="cetak/cetak_pelanggan" class="btn btn-sm  btn-primary" target="_blank">CETAK PDF</a>
            </div>
            <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                <a href="#add" class="btn btn-sm btn-secondary">BELUM BAYAR</a>&nbsp;
                <a href="{{url('/')}}/admin/paket" class="btn btn-sm btn-secondary">PAKET INTERNET</a>&nbsp;
                <a href="{{url('/')}}/admin/letakserver" class="btn btn-sm btn-secondary">LETAK SERVER</a>&nbsp;
                <a href="#add" class="btn btn-sm btn-secondary">TAMBAH PELANGGAN</a>&nbsp;
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th  width="5%" class="text-center">Bayar Cepat</th>
                            <th>NIK - Nama</th>
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
$ambiltagihankurangberapa = DB::table('tagihandetail')
    ->where('nik',$data->nik)
    ->where('thbln',date("Y-m"))
    ->sum('bayar');

    // dd($ambiltagihankurangberapa);

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
                        if(($data->paket_harga-$ambiltagihankurangberapa)==0){
                            echo'<button type="Simpan" class="btn btn-success" disabled>LUNAS!</button>';
                        }else{
                    @endphp
                <div class="col-lg-6">
                    <div class="form-group">
                        <b><label class="form-control-label" for="input-nominal" id="inputnominalinternetlabel">@currency(($data->paket_harga-$ambiltagihankurangberapa))</label></b>
                        <input type="hidden" name="nik" value="{{ $data->nik }}">
                        <input type="hidden" name="paket_id" value="{{ $data->paket_id }}">
                        <input type="hidden" name="paket_nama" value="{{ $data->paket_nama }}">
                        <input type="hidden" name="nama" value="{{ $data->nama }}">
                        <input type="hidden" name="paket_harga" value="{{ $data->paket_harga }}">
                        <input type="hidden" name="paket_kecepatan" value="{{ $data->paket_kecepatan }}">
                        <input type="hidden" name="ambiltagihankurangberapa" value="{{ $ambiltagihankurangberapa }}">
                        <input type="number" name="nominal" id="inputnominalinternet"
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
                    $("#inputnominalinternet").on('keyup', function() {
                        // alert("oops!");
                        $('#inputnominalinternetlabel:last').text(format($(this).val()));
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
                                 <!-- Modal large-->
                                 <button type="button" class="btn btn-primary btn-sm waves-effect" data-toggle="modal" data-target="#large-Modal{{ $data->id }}"><span class="pcoded-micon"> <i
                                    class="feather icon-credit-card"></i></span></button>


                                {{-- {{ ($loop->index)+1 }} --}}
                                {{-- <a class="btn btn-success btn-sm btn-outline-success"
                                href="/admin/tagihan/{{$data->nik}}/bayar"><span class="pcoded-micon"> <i
                                        class="feather icon-shopping-cart"></i></span></a> --}}



                            </td>
                            <td>{{$data->nik}} - {{$data->nama}}</td>
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
                        @endforeach
                        <tfoot>
                            <tr>
                                <th class="text-center">Bayar</th>
                                <th>NIK - Nama</th>
                                <th>No WA</th>
                                <th>Tanggal Gabung</th>
                                <th class="text-center">Status Langganan</th>
                                <th class="text-center">Paket</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->
    <!-- tambah -->
    <div class="card" id="add" >
        <div class="card-header">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <h5 class="label label-success">TAMBAH PELANGGAN</h5>
                </div>
                <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                <a href="{{url('/')}}/admin/paket" class="btn btn-sm btn-secondary">PAKET INTERNET</a>&nbsp;
                <a href="{{url('/')}}/admin/letakserver" class="btn btn-sm btn-secondary">LETAK SERVER</a>&nbsp;
                    <a href="#datatable" class="btn btn-sm btn-secondary">PELANGGAN</a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/pelanggan" method="post">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nik">NIK (*</label>
                                    <input type="text" name="nik" id="input-nik"
                                        class="form-control form-control-alternative  @error('nik') is-invalid @enderror"
                                        placeholder="" value="{{old('nik')}}" required>
                                    @error('nik')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="" value="{{old('nama')}}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-alamat">Alamat (*</label>
                                    <input type="text" name="alamat" id="input-alamat"
                                        class="form-control form-control-alternative  @error('alamat') is-invalid @enderror"
                                        placeholder="" value="{{old('alamat')}}" required>
                                    @error('alamat')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-hp">No WA (*</label>
                                    <input type="text" name="hp" id="input-hp"
                                        class="form-control form-control-alternative  @error('hp') is-invalid @enderror"
                                        placeholder="" value="{{old('hp')}}" required>
                                    @error('hp')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-tgl_gabung">Tanggal Gabung(*</label>
                                    <input type="date" name="tgl_gabung" id="input-tgl_gabung"
                                        class="form-control form-control-alternative  @error('tgl_gabung') is-invalid @enderror"
                                        placeholder="" value="{{$blnthn}}-{{ $tglskrg }}"required>

                                    @error('tgl_gabung')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-4 col-sm-4 col-xl-4 m-b-30">
                                <label class="form-control-label" for="input-jk">Pilih Paket  (*</label>
                                <select name="paket_id" id="input-paket_id"
                                    class="form-control form-control-info  @error('paket_id') is-invalid @enderror"
                                    required>
                            <?php
                                $data2s = DB::table('paket')->orderBy('kecepatan', 'asc')->get();
                            ?>
                                @foreach($data2s as $d2)
                                        <option value="{{ $d2->id }}">{{ $d2->nama }} - {{$d2->kecepatan}} Mbps</option>
                                @endforeach
                                        </select> @error('paket_id')<div class="invalid-feedback"> {{$message}}
                                        </div>
                                @enderror
                            </div>


                            <div class="col-lg-4 col-sm-4 col-xl-4 m-b-30">
                                <label class="form-control-label" for="input-jk">Pilih Letak Server  (*</label>
                                <select name="letakserver_id" id="input-letakserver_id"
                                    class="form-control form-control-info  @error('letakserver_id') is-invalid @enderror"
                                    required>
                            <?php
                                $data3s = DB::table('letakserver')->orderBy('nama', 'asc')->get();
                            ?>
                                @foreach($data3s as $d3)
                                        <option value="{{ $d3->id }}">{{ $d3->nama }}</option>
                                @endforeach
                                        </select> @error('letakserver_id')<div class="invalid-feedback"> {{$message}}
                                        </div>
                                @enderror
                            </div>

                            <div class="col-lg-4 col-sm-4 col-xl-4 m-b-30">
                                <label class="form-control-label" for="input-jk">Pilih Status Langganan  (*</label>
                                <select name="status_langganan" id="input-status_langganan"
                                    class="form-control form-control-info  @error('status_langganan') is-invalid @enderror"
                                    required>

                                        <option>Aktif</option>
                                        <option>Non-Aktif</option>

                                        </select> @error('status_langganan')<div class="invalid-feedback"> {{$message}}
                                        </div>
                                @enderror
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-koordinat">Kordinat Rumah (*</label>
                                     <input type="text" name="kordinat_rumah" id="input-koordinat"  class="form-control form-control-alternative  @error('kordinat_rumah') is-invalid @enderror"
                              placeholder="" value="{{old('kordinat_rumah')}}" required>
                              @error('kordinat_rumah')<div class="invalid-feedback"> {{$message}}</div>
                              @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-control-label " for="input-koordinat">&nbsp; </label>
                                <div class="form-group">
                                    <button type="Simpan" class="btn btn-success">Simpan</button>
                                </div>
                            </div>

                            <div id="mapCanvas"></div>
                            <div id="infoPanel">
                              <b>Marker status:</b>
                              <div id="markerStatus"><i>Click and drag the marker.</i></div>
                              <b>Current position:</b>
                              <div id="info"></div>
                              {{-- <b>Closest matching address:</b>
                              <div id="address"></div> --}}
                            </div><script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

                            <script>

                                var geocoder = new google.maps.Geocoder();

                                function geocodePosition(pos) {
                                geocoder.geocode({
                                    latLng: pos
                                }, function(responses) {
                                    if (responses && responses.length > 0) {
                                    updateMarkerAddress(responses[0].formatted_address);
                                    } else {
                                    updateMarkerAddress('Cannot determine address at this location.');
                                    }
                                });
                                }

                                function updateMarkerStatus(str) {
                                document.getElementById('markerStatus').innerHTML = str;
                                }

                                function updateMarkerPosition(latLng) {
                                document.getElementById('info').innerHTML = [
                                    latLng.lat(),
                                    latLng.lng()
                                ].join(', ');
                                document.getElementById("input-koordinat").value = [
                                    latLng.lat(),
                                    latLng.lng()
                                ].join(', ');
                                }

                                function updateMarkerAddress(str) {
                                document.getElementById('address').innerHTML = str;
                                }

                                function initialize() {
                                var latLng = new google.maps.LatLng(-8.129902243245665, 112.4867915739301);
                                var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                                    zoom: 15,
                                    center: latLng,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                });
                                var marker = new google.maps.Marker({
                                    position: latLng,
                                    title: 'Point A',
                                    map: map,
                                    draggable: true
                                });

                                // Update current position info.
                                updateMarkerPosition(latLng);
                                geocodePosition(latLng);

                                // Add dragging event listeners.
                                google.maps.event.addListener(marker, 'dragstart', function() {
                                    updateMarkerAddress('Dragging...');
                                });

                                google.maps.event.addListener(marker, 'drag', function() {
                                    updateMarkerStatus('Dragging...');
                                    updateMarkerPosition(marker.getPosition());
                                });

                                google.maps.event.addListener(marker, 'dragend', function() {
                                    updateMarkerStatus('Drag ended');
                                    geocodePosition(marker.getPosition());
                                });
                                }

                                // Onload handler to fire off the app.
                                google.maps.event.addDomListener(window, 'load', initialize);

                                // $("#input-harga").on('keyup', function() {
                                //     // alert("oops!");
                                //     $('#input-harga-label:last').text(format($(this).val()));
                                // });
                            </script>
                            <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB35N54GJSZlfnaC1HWjWjoExGy2JuXroc&callback=initMap&libraries=&v=weekly"
                            async
                          ></script>


                        </div>
                    </div>

                </form>
    </div>
</div>
</div>
<!-- tambah end -->

</div>
<!-- Section end -->






<!-- page body -->
@endsection
