
@extends('admin.main')

@section('title','Dashboard')

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous"></script>



@endsection
@php
    $blnthn=date("Y-m");
    $list=array();
$month = date("m");
$year = date("Y");
$tglskrg = date("d");
$pelanggan_lunas=0;


//ambil data pelanggan status langgan aktif
$ambildatapelangganaktif = DB::table('pelanggan')
        ->where('status_langganan', '=', 'Aktif')
        ->count();

//ambil data pelanggan di tagihan
    $ambildatapelanggantagihan = DB::table('tagihan')
        ->where('thbln', '=', $blnthn)
        ->get();

        foreach ($ambildatapelanggantagihan as $ambildata1) {
            $nik=$ambildata1->nik;
            $paket_id=$ambildata1->paket_id;
            $paket_harga=$ambildata1->paket_harga;
            //ambiltotalbayar
            $ambiltotalbayar= DB::table('tagihan')
                ->where('thbln', '=', $blnthn)
                ->where('nik', '=', $nik)
                ->sum('total_bayar');

            //periksa jika data sama dengan paketharga maka tambahkan $pelanggan_lunas
            if($ambiltotalbayar==$paket_harga){
                    $pelanggan_lunas+=1;
            }

        }


    //Total pemasukan kotor
    // $ambiltotalpendapatankotor = DB::table('tagihan')
    //     ->whereMonth('thbln', '=', $blnthn)
    //     ->sum('nominal');
// for($d=1; $d<=31; $d++)
// {
//     $time=mktime(12, 0, 0, $month, $d, $year);
//     if (date('m', $time)==$month)
//         $list[]=date('Y-m-d-D', $time);
// }
// echo "<pre>";
// print_r($list);
// echo "</pre>";
    // dd($blnthn)

    // //basic selec where
    // $ambildata = DB::table('pendapatan')
    //             ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
    //             ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
    //             ->get();
    // //selek pemasukan jumlahkan per tanggal
    // $ambildata2 = DB::table('pendapatan')
    //             ->where('tgl', '=', $year."-".$month."-".$tglskrg)
    //             ->sum('nominal');


    //jumlah pemasukan
    $ambiljmlhpendapatan = DB::table('pendapatan')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->count();

    //Total pemasukan dari  pendapatan
    $ambiltotalpendapatan = DB::table('pendapatan')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->sum('nominal');

    //jumlah pengeluaran
    $ambiljmlhpengeluaran = DB::table('pengeluaran')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->count();

    //Total pengeluaran dari  pengeluaran
    $ambiltotalpengeluaran = DB::table('pengeluaran')
        ->whereMonth('tgl', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl', '=', date("Y",strtotime($blnthn)))
        ->sum('nominal');

    //jumlah pelanggan yang telah membayar
    $ambiljmlhpembayar = DB::table('tagihan')
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
        ->count();

    //Total pemasukan dari  internet
    $ambiltotalinternetbulanini = DB::table('tagihan')
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
        ->sum('total_bayar');

                // dd($ambiljmlhpembayar)
@endphp
@section('jshere')
<!-- js-->

<!-- Chart js -->
<script type="text/javascript" src="{{ asset("admin-style/") }}/files/bower_components/chart.js/js/Chart.js"></script>
<!-- amchart js -->
<script src="{{ asset("admin-style/") }}/files/assets/pages/widget/amchart/amcharts.js"></script>
<script src="{{ asset("admin-style/") }}/files/assets/pages/widget/amchart/serial.js"></script>
<script src="{{ asset("admin-style/") }}/files/assets/pages/widget/amchart/light.js"></script>

{{-- <script type="text/javascript" src="{{ asset("admin-style/") }}/files/assets/pages/dashboard/analytic-dashboard.min.js"></script> --}}
{{-- data dashboard --}}
<script>
"use strict";
$(document).ready(function () {
    function e(e, t, a) {
        return null == a && (a = "rgba(0,0,0,0)"), {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"],
            datasets: [{
                label: "",
                borderColor: e,
                borderWidth: 2,
                hitRadius: 30,
                pointRadius: 3,
                pointHoverRadius: 4,
                pointBorderWidth: 5,
                pointHoverBorderWidth: 12,
                pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                pointBorderColor: e,
                pointHoverBackgroundColor: e,
                pointHoverBorderColor: Chart.helpers.color("#000000").alpha(.1).rgbString(),
                fill: !0,
                lineTension: 0,
                backgroundColor: a,
                data: t
            }]
        }
    }

    function t() {
        return {
            title: {
                display: !1
            },
            tooltips: {
                position: "nearest",
                mode: "index",
                intersect: !1,
                yPadding: 10,
                xPadding: 10
            },
            legend: {
                display: !1,
                labels: {
                    usePointStyle: !1
                }
            },
            responsive: !0,
            maintainAspectRatio: !0,
            hover: {
                mode: "index"
            },
            scales: {
                xAxes: [{
                    display: !1,
                    gridLines: !1,
                    scaleLabel: {
                        display: !0,
                        labelString: "Month"
                    }
                }],
                yAxes: [{
                    display: !1,
                    gridLines: !1,
                    scaleLabel: {
                        display: !0,
                        labelString: "Value"
                    },
                    ticks: {
                        beginAtZero: !0
                    }
                }]
            },
            elements: {
                point: {
                    radius: 4,
                    borderWidth: 12
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 100,
                    top: 25,
                    bottom: 25
                }
            }
        }
    }
    var a = (AmCharts.makeChart("visitor", {
        type: "serial",
        hideCredits: !0,
        theme: "light",
        dataDateFormat: "YYYY-MM-DD",
        precision: 2,
        valueAxes: [{
            id: "v1",
            title: "Pemasukan",
            position: "left",
            autoGridCount: !1,
            labelFunction: function (e) {
                return "Rp" + Math.round(e) + ",00"
            }
        }, {
            id: "v2",
            title: "Pengeluaran",
            gridAlpha: 0,
            position: "right",
            autoGridCount: !1
        }],
        graphs: [{
            id: "g3",
            valueAxis: "v1",
            lineColor: "#feb798",
            fillColors: "#feb798",
            fillAlphas: 1,
            type: "column",
            title: "Pengeluaran",
            valueField: "sales2",
            clustered: !1,
            columnWidth: .5,
            legendValueText: "[[value]]",
            balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }, {
            id: "g4",
            valueAxis: "v1",
            lineColor: "#65d0fe",
            fillColors: "#65d0fe",
            fillAlphas: 1,
            type: "column",
            title: "Pemasukan",
            valueField: "sales1",
            clustered: !1,
            columnWidth: .3,
            legendValueText: "[[value]]",
            balloonText: "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
        }],
        chartCursor: {
            pan: !0,
            valueLineEnabled: !0,
            valueLineBalloonEnabled: !0,
            cursorAlpha: 0,
            valueLineAlpha: .2
        },
        categoryField: "date",
        categoryAxis: {
            parseDates: !0,
            dashLength: 1,
            minorGridEnabled: !0
        },
        legend: {
            useGraphSettings: !0,
            position: "top"
        },
        balloon: {
            borderThickness: 1,
            cornerRadius: 5,
            shadowAlpha: 0
        },
        dataProvider: [

@php
$nol=0;
            for($d=1; $d<=31; $d++)
            {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                    $tgl=date('Y-m-').$d;

            //tambahkan 0 jika d dibawah10
            $d <10 ? $nol='0' : $nol='';

        $acak=rand(10000,100000);
        $acak2=rand(10000,100000);
        $acak3=rand(10000,100000);
                //ambil pemasukan
        $ambilpemasukan = DB::table('pendapatan')
                ->where('tgl', '=', $year."-".$month."-".$nol.$d)
                ->sum('nominal');

                //ambil pengeluaran
        $ambilpengeluaran = DB::table('pengeluaran')
                ->where('tgl', '=', $year."-".$month."-".$nol.$d)
                ->sum('nominal');

                // dd($ambilpengeluaran);


@endphp

        {
            date: "{{ $tgl }}",
            market1: 0,
            market2: 0,
            sales1:  {{ $ambilpemasukan }},
            sales2: {{ $ambilpengeluaran }}
        },
@php
// $nomor++;
}
    // $tgl='2021-05-'.$loop->index;

@endphp



     ]
    }), AmCharts.makeChart("proj-earning", {
        type: "serial",
        hideCredits: !0,
        theme: "light",
        dataProvider: [

@php
            for($d=1; $d<=31; $d++)
            {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                    $tgl=date('Y-m-').$d;

            //tambahkan 0 jika d dibawah10
            $d <10 ? $nol='0' : $nol='';

                    $tglsaja=$d;

                       //ambil tagihan
        $ambiltagihan = DB::table('tagihan')
        ->whereDay('tgl_bayar', '=', $d)
        ->whereMonth('tgl_bayar', '=', date("m",strtotime($blnthn)))
        ->whereYear('tgl_bayar', '=', date("Y",strtotime($blnthn)))
                ->sum('total_bayar');

                // dd($ambiltagihan);


        $acak=rand(10000,100000);
        $acak2=rand(10000,100000);
        $acak3=rand(10000,100000);
@endphp
{
            type: "{{ $tglsaja }}",
            visits: {{ $ambiltagihan }}
        },
@php

}
    // $tgl='2021-05-'.$loop->index;

@endphp

    ],
        valueAxes: [{
            gridAlpha: .3,
            gridColor: "#fff",
            axisColor: "transparent",
            color: "#fff",
            dashLength: 0
        }],
        gridAboveGraphs: !0,
        startDuration: 1,
        graphs: [{
            balloonText: "Rp <b>[[value]]</b> ,00",
            fillAlphas: 1,
            lineAlpha: 1,
            lineColor: "#65fe93",
            type: "column",
            valueField: "visits",
            columnWidth: .5
        }],
        chartCursor: {
            categoryBalloonEnabled: !1,
            cursorAlpha: 0,
            zoomable: !1
        },
        categoryField: "type",
        categoryAxis: {
            gridPosition: "start",
            gridAlpha: 0,
            axesAlpha: 0,
            lineAlpha: 0,
            fontSize: 12,
            color: "#fff",
            tickLength: 0
        },
        export: {
            enabled: !1
        }
    }), document.getElementById("newuserchart").getContext("2d"));
    window.myDoughnut = new Chart(a, {
        type: "doughnut",
        data: {
            datasets: [{
                data: [10, 34, 5],
                backgroundColor: ["#fe9365", "#01a9ac", "#fe5d70"],
                label: "Dataset 1"
            }],
            labels: ["Satisfied", "Unsatisfied", "NA"]
        },
        options: {
            maintainAspectRatio: !1,
            responsive: !0,
            legend: {
                position: "bottom"
            },
            title: {
                display: !0,
                text: ""
            },
            animation: {
                animateScale: !0,
                animateRotate: !0
            }
        }
    });
    var a = document.getElementById("sale-chart1").getContext("2d"),
        a = (new Chart(a, {
            type: "line",
            data: e("#b71c1c", [25, 30, 15, 20, 25, 30, 15, 25, 35, 30, 20, 10, 12, 1], "transparent"),
            options: t()
        }), document.getElementById("sale-chart2").getContext("2d")),
        a = (new Chart(a, {
            type: "line",
            data: e("#00692c", [30, 15, 25, 35, 30, 20, 25, 30, 15, 20, 25, 10, 12, 1], "transparent"),
            options: t()
        }), document.getElementById("sale-chart3").getContext("2d"));
    new Chart(a, {
        type: "line",
        data: e("#096567", [15, 20, 25, 10, 30, 15, 25, 35, 30, 20, 25, 30, 12, 1], "transparent"),
        options: t()
    })
});

</script>
@endsection

@section('headernav')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>Dashboard</h4>
                    {{-- <span>Selamat datang di Halaman Beranda Administrator.</span> --}}
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

          <!-- visitor start -->
          <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="label label-info">Pemasukan dan Pengeluaran Bulan ini</h5>
                    {{-- <span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span> --}}
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-maximize full-card"></i></li>
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-trash-2 close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div id="visitor" style="height:300px"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="label label-info">Pemasukan dari Pembayaran Internet</h5>
                </div>
                <div class="card-block bg-c-green">
                    <div id="proj-earning" style="height: 230px"></div>
                </div>
                <div class="card-footer">
                    {{-- <h6 class="text-muted m-b-30 m-t-15">Total Pembayaran Tagihan Internet</h6> --}}
                    <div class="row text-center">
                        <div class="col-3 b-r-default">
                            <h6 class="text-muted m-b-10">Lunas</h6>
                            <h4 class="m-b-0 f-w-100 ">{{ $pelanggan_lunas }} Pelanggan</h4>
                        </div>
                        <div class="col-3">
                            <h6 class="text-muted m-b-10">Belum lunas</h6>
                            <h4 class="m-b-0 f-w-100 ">{{ $ambildatapelangganaktif-$pelanggan_lunas }} Pelanggan</h4>
                        </div>
                        <div class="col-3">
                            <h6 class="text-muted m-b-10">Total Pembayaran</h6>
                            <h4 class="m-b-0 f-w-100 ">@currency($ambiltotalinternetbulanini)</h4>
                        </div>
                        <div class="col-3">
                            <h6 class="text-muted m-b-10">Total Belum dibayar</h6>
                            <h4 class="m-b-0 f-w-100 ">@currency($ambiltotalinternetbulanini)</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- visitor end -->

        <!-- menubaris2 start -->
        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5 class="label label-info">Pendapatan Bersih</h5>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama </th>
                                    <th>Nominal</th>
                                    <th>Jumlah Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><label class="label label-success">01</label></td>
                                    <td>Pemasukan</td>
                                    <td>@currency($ambiltotalpendapatan)</td>
                                    <td>{{ $ambiljmlhpendapatan }} Data</td>
                                </tr>
                                <tr>
                                    <td><label class="label label-primary">02</label></td>
                                    <td>Pengeluaran</td>
                                    <td>@currency($ambiltotalpengeluaran)</td>
                                    <td>{{ $ambiljmlhpengeluaran }} Data</td>
                                </tr>
                                <tr>
                                    <td><label class="label label-danger">03</label></td>
                                    <td>Pemasukan dari Internet</td>
                                    <td><b>@currency($ambiltotalinternetbulanini)</b></td>
                                    <td>{{ $ambiljmlhpembayar }} Pembayaran</td>
                                </tr>
                                <tr>
                                    <td><label class="label label-secondary">04</label></td>
                                    <td>Pendapatan Bersih</td>
                                    <td><b>@currency(($ambiltotalpendapatan+$ambiltotalinternetbulanini-$ambiltotalpengeluaran))</b></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-right m-r-20">
                            <a href="#!" class=" b-b-primary text-primary">Laporan Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5 class="label label-success">Bayar Internet</h5>
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
                    <div class="card-body">
                        <form action="/admin/tagihan/bayarinternet" method="post">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tgl">Tanggal (*</label>
                                            <input type="date" name="tgl" id="input-tgl"
                                                class="form-control form-control-alternative  @error('tgl') is-invalid @enderror"
                                                placeholder="" value="{{$blnthn}}-{{ $tglskrg }}" required>

                                            @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tgl">Tagihan Bulan</label>
                                            <input type="month" name="thbln" id="input-tgl"
                                                class="form-control form-control-alternative  @error('tgl') is-invalid @enderror"
                                                placeholder="" value="{{$blnthn}}" required>

                                            @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>


                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                        <label class="form-control-label" for="input-jk">Pelanggan  </label>
                                        <select name="nik" id="input-jenispendapatan_id"
                                            class="form-control form-control-info  @error('jenispendapatan_id') is-invalid @enderror"
                                            required>
                                    <?php
                                        $data2p = DB::table('pelanggan')
                                                ->where('status_langganan', '=', "Aktif")
                                                ->get();
                                    ?>
                                        @foreach($data2p as $d2p)
                                                <option value="{{ $d2p->nik }}">{{ $d2p->nama }}</option>
                                        @endforeach
                                                </select> @error('jenispendapatan_id')<div class="invalid-feedback"> {{$message}}
                                                </div>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <b><label class="form-control-label" for="input-nominal" id="inputnominalinternetlabel">Rp. 0 ,00</label></b>
                                            <input type="number" name="nominal" id="inputnominalinternet"
                                                class="form-control form-control-alternative  @error('nominal') is-invalid @enderror"
                                                placeholder="Contoh : 150000" value="{{old('nominal')}}" required>
                                            @error('nominal')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <div class="form-group ">
                                            <button type="Simpan" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
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

            </div>
        </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5 class="label label-success">Tambah Pemasukan</h5>
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
                    <div class="card-body">
                        <form action="/admin/pendapatan" method="post">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
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
                                            <b><label class="form-control-label" for="input-nominal" id="input-pemasukan-label">Rp. 0 ,00</label></b>
                                            <input type="number" name="nominal" id="input-nominal"
                                                class="form-control form-control-alternative  @error('nominal') is-invalid @enderror"
                                                placeholder="Contoh : 150000" value="{{old('nominal')}}" required>
                                            @error('nominal')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
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
                                        $("#input-nominal").on('keyup', function() {
                                            // alert("oops!");
                                            $('#input-pemasukan-label:last').text(format($(this).val()));
                                        });

                                    });
                                    </script>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tgl">Tanggal (*</label>
                                            <input type="date" name="tgl" id="input-tgl"
                                                class="form-control form-control-alternative  @error('tgl') is-invalid @enderror"
                                                placeholder="" value="{{$blnthn}}-{{ $tglskrg }}" required>

                                            @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                        <label class="form-control-label" for="input-jk">Pilih Kategori  (*</label>
                                        <select name="jenispendapatan_id" id="input-jenispendapatan_id"
                                            class="form-control form-control-info  @error('jenispendapatan_id') is-invalid @enderror"
                                            required>
                                    <?php
                                        $data2s = DB::table('jenispendapatan')->get();
                                    ?>
                                        @foreach($data2s as $d2)
                                                <option value="{{ $d2->id }}">{{ $d2->nama }}</option>
                                        @endforeach
                                                </select> @error('jenispendapatan_id')<div class="invalid-feedback"> {{$message}}
                                                </div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="Simpan" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5 class="label label-success">Tambah Pengeluaran</h5>
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
                    <div class="card-body">
                        <form action="/admin/pengeluaran" method="post">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-nama">Nama(*</label>
                                            <input type="text" name="nama" id="input-nama"
                                                class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                                placeholder="" value="{{old('nama')}}" required>
                                            @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-nominal">Nominal  (*</label> -
                                            <b><label class="form-control-label" for="input-nominal" id="input-pengeluaran-label">Rp. 0 ,00</label></b>
                                            <input type="number" name="nominal" id="input-nominal2"
                                                class="form-control form-control-alternative  @error('nominal') is-invalid @enderror"
                                                placeholder="Contoh : 150000" value="{{old('nominal')}}" required>
                                            @error('nominal')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
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
                                        $("#input-nominal2").on('keyup', function() {
                                            // alert("oops!");
                                            $('#input-pengeluaran-label:last').text(format($(this).val()));
                                        });

                                    });
                                    </script>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-tgl">Tanggal (*</label>
                                            <input type="date" name="tgl" id="input-tgl"
                                                class="form-control form-control-alternative  @error('tgl') is-invalid @enderror"
                                                placeholder="" value="{{$blnthn}}-{{ $tglskrg }}"required>

                                            @error('tgl')<div class="invalid-feedback"> {{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                        <label class="form-control-label" for="input-jk">Pilih Kategori  (*</label>
                                        <select name="jenispengeluaran_id" id="input-jenispengeluaran_id"
                                            class="form-control form-control-info  @error('jenispengeluaran_id') is-invalid @enderror"
                                            required>
                                    <?php
                                        $data2s = DB::table('jenispengeluaran')->get();
                                    ?>
                                        @foreach($data2s as $d2)
                                                <option value="{{ $d2->id }}">{{ $d2->nama }}</option>
                                        @endforeach
                                                </select> @error('jenispengeluaran_id')<div class="invalid-feedback"> {{$message}}
                                                </div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="Simpan" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
            </div>
        </div>

        <!-- menubaris2 end -->

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

