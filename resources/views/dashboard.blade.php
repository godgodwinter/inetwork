
@extends('admin.main')

@section('title','Dashboard')

@section('headernav')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Dashboard</h4>
                    <span>Selamat datang di Halaman Beranda Administrator.</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">@yield('title')</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('container')


  <!-- Page-body start -->
  <div class="page-body">
    <div class="row">

<!-- widget-statstic end -->

<!-- Seluruh Menu Start -->
<!-- Seluruh Menu end -->

</div>
</div>
<!-- page body -->
@endsection

