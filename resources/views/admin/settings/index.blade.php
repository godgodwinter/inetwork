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

<div class="row">
    <!-- latest activity end -->
    <div class="col-xl-8 col-md-12">
        <div class="card latest-activity-card">
            <div class="card-header">
                <h5>Pengaturan Dasar</h5>
            </div>
            <div class="card-block">
                <div class="latest-update-box">
                    <div class="row p-t-20 p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">just now</p>
                            <i class="feather icon-sunrise bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>John Deo</h6>
                            <p class="text-muted m-b-15">The trip was an amazing and a life changing experience!!</p>
                            <img src="../files/assets/images/mega-menu/01.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                            <img src="../files/assets/images/mega-menu/03.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                        </div>
                    </div>
                    <div class="row p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">5 min ago</p>
                            <i class="feather icon-file-text bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Administrator</h6>
                            <p class="text-muted m-b-0">Free courses for all our customers at A1 Conference Room - 9:00 am tomorrow!</p>
                        </div>
                    </div>
                    <div class="row p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline">3 hours ago</p>
                            <i class="feather icon-map-pin bg-simple-c-blue update-icon"></i>
                        </div>
                        <div class="col">
                            <h6>Jeny William</h6>
                            <p class="text-muted m-b-15">Happy Hour! Free drinks at <span class="text-c-blue">Cafe-Bar all </span>day long!</p>
                            <div id="markers-map" style="height:200px;width:100%"></div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="#!" class=" b-b-primary text-primary">View all Activity</a>
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
                <div class="row m-b-25">
                    <div class="col-auto p-r-0">
                        <img src="../files/assets/images/mega-menu/01.jpg" alt="" class="img-fluid img-50">
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">New able - Redesign</h6>
                        <p class="text-c-pink m-b-0">2 Days Remaining</p>
                    </div>
                </div>
                <div class="row m-b-25">
                    <div class="col-auto p-r-0">
                        <img src="../files/assets/images/mega-menu/02.jpg" alt="" class="img-fluid img-50">
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">New Admin Dashboard</h6>
                        <p class="text-c-pink m-b-0">Proposal in 6 Days</p>
                    </div>
                </div>
                <div class="row m-b-25">
                    <div class="col-auto p-r-0">
                        <img src="../files/assets/images/mega-menu/03.jpg" alt="" class="img-fluid img-50">
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Logo Design</h6>
                        <p class="text-c-green m-b-0">10 Days Remaining</p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#!" class="b-b-primary text-primary">View all Feeds</a>
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
                        <h6 class="m-b-5">Reset Pengaturan. <span class="text-muted f-right f-13">Just Now</span></h6>
                    </div>
                </div>
                <div class="row m-b-30">
                    <div class="col-auto p-r-0">
                        <i class="feather icon-shopping-cart bg-simple-c-pink feed-icon"></i>
                    </div>
                    <div class="col">
                        <h6 class="m-b-5">Reset Data / Hapus Semua data<span class="text-muted f-right f-13">Just Now</span></h6>
                    </div>
                </div>

                <div class="text-center">
                    <a href="#!" class="b-b-primary text-primary">View all Feeds</a>
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
