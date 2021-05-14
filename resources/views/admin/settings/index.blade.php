@php
  $datas2 = DB::table('settings')
  ->whereraw("kunci='web_kordinat'")->get();
  foreach ($datas2 as $data2) {
      $web_kordinat=$data2->nilai;
  }
@endphp
@extends('admin.layouts.nav1-min')

@section('title','PENGATURAN WEB')

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
                    <h4>@yield('title')</h4>
                    {{-- <span>Halaman Mastering @yield('title')</span> --}}
                </div>
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
@foreach ($datas as $data)
@endforeach
{{-- {{ dd($datas['0']->nilai) }} --}}

<div class="row">
    <!-- latest activity end -->
    <div class="col-xl-8 col-md-12">
        <div class="card latest-activity-card">
            <div class="card-header">
                <h5>Pengaturan Dasar</h5>
            </div>
            <div class="card-block">
                <div class="latest-update-box">

                <form action="/admin/settings/update" method="post">
                    @method('put')
                    @csrf

                    <div class="row p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">Website</p>
                            <i class="feather icon-file-text bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <label for="input-web_nama" >Nama Website</label>

                                <div class="form-group">
                                    <div class="tm_editable_container input-group theme1" id="text_demo" data-iplaceholder="Type Something..">
                                        <input type="text" name="web_nama"  id="input-web_nama" value="{{ ($datas['1']->nilai) }}" class="w-inherit form-control  @error('nama') is-invalid @enderror" required/>
                                        @error('web_nama')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="col">
                            <label for="input-web_motto" ><span class="text-c-blue">Motto</span> Website</label>

                                <div class="form-group">
                                    <div class="tm_editable_container input-group theme1" id="text_demo" data-iplaceholder="Type Something..">
                                        <input type="text" name="web_motto"  id="input-web_motto" value="{{ ($datas['2']->nilai) }}" class="w-inherit form-control  @error('nama') is-invalid @enderror" required/>
                                        @error('web_motto')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>


                    </div>

                    <div class="row p-t-20 p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">Menu</p>
                            <i class="feather icon-sunrise bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <label for="input-tourmenu" >Menu Tour / Penunjuk</label>

                                <div class="form-group">
                                    <div class="tm_editable_container input-group theme1" id="text_demo" data-iplaceholder="Type Something..">
                                        <input type="text" name="tourmenu"  id="input-tourmenu" value="{{ ($datas['0']->nilai) }}" class="w-inherit form-control  @error('nama') is-invalid @enderror" required/>
                                        @error('tourmenu')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="row p-t-20 p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline"></p>
                            <i class="feather icon-sunrise bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <label for="input-koordinat" >Kordinat Default</label>

                                <div class="form-group">
                                    <div class="tm_editable_container input-group theme1" id="text_demo" data-iplaceholder="Type Something..">
                                        <input type="text" name="web_kordinat"  id="input-koordinat" value="{{ ($datas['4']->nilai) }}" class="w-inherit form-control  @error('nama') is-invalid @enderror" required/>
                                        @error('web_kordinat')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
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
                            </div>
                            <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false">
                            </script>

                            <script>
                                var geocoder = new google.maps.Geocoder();

                                function geocodePosition(pos) {
                                    geocoder.geocode({
                                        latLng: pos
                                    }, function (responses) {
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
                                    var latLng = new google.maps.LatLng({{$web_kordinat}});
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
                                    google.maps.event.addListener(marker, 'dragstart', function () {
                                        updateMarkerAddress('Dragging...');
                                    });

                                    google.maps.event.addListener(marker, 'drag', function () {
                                        updateMarkerStatus('Dragging...');
                                        updateMarkerPosition(marker.getPosition());
                                    });

                                    google.maps.event.addListener(marker, 'dragend', function () {
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
                            {{-- <script
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_1p87NSoGahFKRgZZBrNrPqtflNzAA4E&callback=initMap&libraries=&v=weekly"
                                async></script> --}}

                            <script
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtNKJcbjGJYCXRrGBvnWr5WDz55XSWXug&callback=initMap&libraries=&v=weekly"
                            async></script>
                                {{-- <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb3AXXxF7JGRWmixh5FHJ7c6-6XnvAzwQ&callback=initMap"> --}}
                            </script>

                        </div>
                    </div>

                    <div class="row p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">Lain-lain</p>
                            <i class="feather icon-map-pin bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Loading</h6>
                            <p class="text-muted m-b-15">Happy Hour! Free drinks at <span class="text-c-blue">Cafe-Bar all </span>day long!</p>
                        </div>
                        <div class="col">
                            <h6>Template</h6>
                            <p class="text-muted m-b-15">Happy Hour! Free drinks at <span class="text-c-blue">Cafe-Bar all </span>day long!</p>
                        </div>
                    </div>


                </div>


                <div class="text-right">
                    <div class="form-group">
                        <button type="Simpan" class="btn btn-success btn-grd-*">Simpan</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-12">
        <div class="card feed-card">
            <div class="card-header">
                <h5>Upload Logo</h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa fa-wrench open-card-option"></i></li>
                        <li><i class="fa fa-window-maximize full-card"></i></li>
                        <li><i class="fa fa-minus minimize-card"></i></li>
                        <li><i class="fa fa-refresh reload-card"></i></li>
                        <li><i class="fa fa-trash close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <form action="{{ url('upload') }}" enctype="multipart/form-data" method="POST">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                  </div>

                  <div class="tampil" style="display:none">
                    <img src="" style="height:300px;width:500px">
                  </div>

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Gambar: 150 px x 30 px</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                  <div class="form-group">
                    <button class="btn btn-success upload-image" type="submit">SIMPAN</button>
                  </div>
                </form>

                <hr>

                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

                <script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
  $("body").on("click",".upload-image",function(e){
    $(this).parents("form").ajaxForm(options);
  });

  var options = {
    complete: function(response)
    {
    	if($.isEmptyObject(response.responseJSON.error)){
    		$("input[name='judul']").val('');
        $(".tampil").css('display','block');
        $(".tampil").find('img').attr('src','/gambar/'+response.responseJSON.gambar);
    		alert('Upload gambar berhasil.');
    	}else{
    		printErrorMsg(response.responseJSON.error);
    	}
    }
  };

  function printErrorMsg (msg) {
	$(".print-error-msg").find("ul").html('');
	$(".print-error-msg").css('display','block');
	$.each( msg, function( key, value ) {
		$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
	});
  }
</script>
                <div class="row m-b-25">
                    <div class="col-auto p-r-0  bg-c-blue">
                       {{-- <img class="img-fluid" src="{{ asset('uploads/') }}/{{ ($datas['3']->nilai) }}"
                        alt="Theme-Logo" /> --}}
                        <img src="{{ asset('uploads/') }}/{{ ($datas['3']->nilai) }}" alt="" class="img-fluid img-150">
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">{{ ($datas['3']->nilai) }}</h6>
                        <p class="text-c-pink m-b-0">uploaded at {{ date("Y-m-d H:u:s") }}</p>
                    </div>
                </div>


                <div class="text-center">

                </div>
            </div>
        </div>
        <div class="card feed-card">
            <div class="card-header">
                <h5>Reset</h5>
            </div>
            <div class="card-block">
                <div class="row m-b-30">
                    <div class="col-auto p-r-0">
                        <i class="feather icon-bell bg-simple-c-blue feed-icon"></i>
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Reset Pengaturan.
                        <span class="text-muted f-right f-13">
                            <div class="form-group">
                            <button type="Simpan" class="btn btn-inverse btn-skew btn-sm">RESET SETTINGS</button>
                            </div>
                        </span></h6>
                    </div>
                </div>
                <div class="row m-b-30">
                    <div class="col-auto p-r-0">
                        <i class="feather icon-shopping-cart bg-simple-c-pink feed-icon"></i>
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Reset Data / Hapus Semua data
                            <span class="text-muted f-right f-13">
                            <div class="form-group">
                            <button type="Simpan" class="btn btn-inverse btn-skew btn-sm">RESET ALL DATA'S</button>
                            </div>
                        </span></h6>
                    </div>
                </div>

                <div class="text-center">
                    <a href="#!" class="b-b-primary text-primary">Backup dahulu</a>
                </div>
            </div>
        </div>
    </div>
    <!-- latest activity end -->
</div>

<!-- Section start -->
<div class="page-body"id="loadtime" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-lg-12 ml-1 mt-1">

Halaman di muat dalam {{ number_format((microtime(true) - LARAVEL_START),2) }} detik.
            </div>
        </div>
    </div>
</div>
<!-- Section end -->

@endsection
