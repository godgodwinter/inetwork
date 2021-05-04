@extends('admin.layouts.nav1')

@section('title','PENDAPATAN BERSIH')

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
{{-- <!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="{{ asset("admin-style/") }}\files\assets\pages\advance-elements\moment-with-locales.min.js"></script>
<script type="text/javascript" src="{{ asset("admin-style/") }}\files\bower_components\bootstrap-datepicker\js\bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{{ asset("admin-style/") }}\files\assets\pages\advance-elements\bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="{{ asset("admin-style/") }}\files\bower_components\bootstrap-daterangepicker\js\daterangepicker.js"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="{{ asset("admin-style/") }}\files\bower_components\datedropper\js\datedropper.min.js"></script>
<!-- Color picker js -->
<script type="text/javascript" src="{{ asset("admin-style/") }}\files\bower_components\spectrum\js\spectrum.js"></script>
<script type="text/javascript" src="{{ asset("admin-style/") }}\files\bower_components\jscolor\js\jscolor.js"></script> --}}

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
            <div class="col-xl-6 col-md-6">
                <a href="import" class="btn btn-sm  btn-primary" target="_blank">IMPORT</a>
                <a href="export" class="btn btn-sm  btn-primary" target="_blank">EXPORT</a>
                <a href="cetak" class="btn btn-sm  btn-primary" target="_blank">CETAK PDF</a>
            </div>
            <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                <form action="/admin/rekapbln/" method="get" class="d-inline">

                <input class="form-control" type="month" name="blnthn" value="{{ $blnthn }}" required><button type="Simpan" class="btn btn-success">PILIH</button>
                </form>


            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">NO</th>
                            <th>NAMA</th>
                            <th>NOMINAL</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td colspan="2"><b>PEMASUKAN</b></td>
                            <td><b>@currency($totaldapat)</b></td>
                        </tr>
                            @foreach ($dpendapatans as $ddapat)
                            <tr>
                                <td class="text-center">-</td>
                                <td>{{ $ddapat->nama }}</td>
                                <td>@currency($ddapat->nominal)</td>
                                <td></td>
                            </tr>
                            @endforeach
                        <tr>
                            <td class="text-center">2</td>
                            <td colspan="2"><B>PEMASUKAN INTERNET</B></td>
                            <td><b>@currency($totaltagihans)</b></td>
                        </tr>
                            @foreach ($dtagihans as $dtagih)
                            <tr>
                                <td class="text-center">-</td>
                                <td>{{ $dtagih->nama }}</td>
                                <td>@currency($dtagih->total_bayar)</td>
                                <td></td>
                            </tr>
                            @endforeach
                        <tr>
                            <td class="text-center">3</td>
                            <td colspan="2"><b>PENGELUARAN</b></td>
                            <td><b>@currency($totalkeluar)</b></td>
                        </tr>
                            @foreach ($dpengeluarans as $dkeluar)
                            <tr>
                                <td class="text-center">-</td>
                                <td>{{ $dkeluar->nama }}</td>
                                <td>@currency($dkeluar->nominal)</td>
                                <td></td>
                            </tr>
                            @endforeach
                        <tr>
                            <td class="text-center">4</td>
                            <td colspan="2"><b>PEMASUKAN BERSIH</b></td>
                            <td><b>@currency($totaldapat+$totaltagihans-$totalkeluar)</b></td>
                        </tr>
                    </tbody>

                        <tfoot>
                            {{-- <tr>
                                <th>-</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Total Pemasukan</th>
                            </tr> --}}
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->
<!-- page body -->
@endsection
