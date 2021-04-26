@extends('admin.main')

@section('title','Letak Server')

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

@foreach ($datas as $data)
@endforeach
@php
    //jika koordinat null -8.129902243245665, 112.4867915739301
if(($data->koordinat)==''){
    $koordinat='-8.129902243245665, 112.4867915739301';
}else{
    $koordinat=$data->koordinat;
}
@endphp
@section('container')
    <!-- tambah -->
    <div class="card" id="add" >
        <div class="card-header">
            <div class="row">

                <div class="col-xl-6 col-md-12">

                    <h5 class="label label-success">TAMBAH</h5>
                </div>

                <div class="col-xl-6 col-md-12 d-flex flex-row-reverse">
                    <a href="#datatable" class="btn btn-sm btn-secondary">DATATABLE</a>

                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/letakserver/{{$data->id}}" method="post">
                    @method('put')
                    @csrf
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama @yield('title')  (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="" value="{{$data->nama}}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-penanggungjawab">Penanggung Jawab  (*</label>
                                    <input type="text" name="penanggungjawab" id="input-penanggungjawab"
                                        class="form-control form-control-alternative  @error('penanggungjawab') is-invalid @enderror"
                                        placeholder="" value="{{$data->penanggungjawab}}" required>

                                    @error('penanggungjawab')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-koordinat">Koordinat  (*</label>
                                     <input type="text" name="koordinat" id="input-koordinat"  class="form-control form-control-alternative  @error('koordinat') is-invalid @enderror"
                              placeholder="" value="{{$data->koordinat}}" required>
                              @error('koordinat')<div class="invalid-feedback"> {{$message}}</div>
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
                                var latLng = new google.maps.LatLng({{$koordinat}});
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
</div>
<!-- tambah end -->
</div>
<!-- Section end -->

<!-- page body -->
@endsection
