@extends('admin.main')

@section('title','TAGIHAN DETAIL')

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


@foreach ($datas as $data)

@endforeach

@php
    //ambil data tagihan detail

        $ambiltotaltelahdibayar = DB::table('tagihandetail')
        ->where('nik',$data->nik)
        ->where('thbln',$data->thbln)
        ->sum('bayar');


        $tgl_gabung="data tidak ditemukan";

        //cari apakah nik pelanggan ada
        $jmlnik = DB::table('pelanggan')
        ->where('nik', '=', $data->nik)
        ->count();
@endphp
<!-- Section start -->
<div class="row">

 <!-- ticket and update start -->
 <div class="col-xl-6 col-md-12">
    <div class="card table-card">
        <div class="card-header">
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
                            <th width="5%"></th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @php
                                    if($jmlnik==0){
                                        echo'<label class="label label-danger">Not Found</label>';
                                    }else{

                                        $dataplgn = DB::table('pelanggan')
                                        ->where('nik', '=', $data->nik)->get();
                                        foreach ($dataplgn as $jn) {
                                            if($jn->status_langganan=='Aktif'){
                                                echo'<label class="label label-success">'.$jn->status_langganan.'</label>';
                                            }else{
                                                echo'<label class="label label-danger">'.$jn->status_langganan.'</label>';}
                                        }
                                    }
                                @endphp

                            </td>
                            <td>NIK</td>
                            <td>{{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nama</td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>NO WA</td>
                            <td>
                                @php
                                    if (($jmlnik)<1){


                                        echo'<span class="pcoded-micon"> <i
                                                    class="feather icon-alert-triangle"></i></span>';

                                    }else{
                                        $jmlnik = DB::table('pelanggan')
                                        ->where('nik', '=', $data->nik)->get();
                                        foreach ($jmlnik as $jn) {
                                            $tgl_gabung=$jn->tgl_gabung;
                                            echo $jn->hp;
                                        }

                                    }
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Paket</td>
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
                            <tr>
                                <td></td>
                                <td>Tagihan</td>
                                <td>@currency($data->paket_harga)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Tanggal Bergabung</td>
                                <td>{{ $tgl_gabung }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Total Bayar</td>
                                <td>@currency($ambiltotaltelahdibayar)</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Kurang</td>
                                <td>@currency(($data->paket_harga-$ambiltotaltelahdibayar))</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    @php
                                        if(($data->total_bayar-$data->paket_harga)==0){
                                                echo'<label class="label label-success">LUNAS</label>';
                                        }else{
                                                echo'<label class="label label-danger">BELUM LUNAS</label>';
                                        }
                                    @endphp
                                </td>
                            </tr>
                        </tr>

                    </tbody>
                </table>
                <div class="text-right m-r-20">
                    <a href=".." class=" b-b-primary text-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="page-body col-xl-6 col-md-12"id="datatable" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <a href="cetak/cetak_tagihan" class="btn btn-sm  btn-primary" target="_blank">CETAK PDF</a>
                <a href="#" class="btn btn-sm  btn-danger" id="deleteAllSelectedRecord">HAPUS TERPILIH</a>&nbsp;
            </div>
            <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                <a href="{{url('/')}}/admin/pelanggan" class="btn btn-sm btn-secondary">PELANGGAN</a>&nbsp;
            </div>
        </div>
        <script>
            $(function(e){
                $("#chkCheckAll").click(function(){
                    $(".checkBoxClass").prop('checked',$(this).prop('checked'));
                })

                $("#deleteAllSelectedRecord").click(function(e){
                    e.preventDefault();
                    var allids=[];
                        $("input:checkbox[name=ids]:checked").each(function(){
                            allids.push($(this).val());
                        });

                $.ajax({
                    url:"{{ route('tagihandetail.deleteSelected') }}",
                    type:"DELETE",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allids
                    },
                    success:function(response){
                        $.each(allids,function($key,val){
                                $("#sid"+val).remove();
                        })
                    }
                });

                })

            });
        </script>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">
                                <input type="checkbox" id="chkCheckAll">
                            </th>
                            <th width="5%" class="text-center">No</th>
                            <th>Tanggal Bayar</th>
                            <th>Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php

// @foreach ($datas as $data)

// @endforeach

    //ambil data tagihan detail

        $ambiltelahdibayar = DB::table('tagihandetail')
        ->where('nik',$data->nik)
        ->where('thbln',$data->thbln)
        ->get();
                    $status_langganan='Non-Aktif';

                                    // if($data->status_langganan=='Aktif'){
                                    //     $status_langganan='Aktif';
                                    // }else{
                                    //     $status_langganan='Non-Aktif';
                                    // }

// dd($tgl);
// {{ \Carbon\Carbon::parse($user->from_date)->format('d/m/Y')}}

                            @endphp
@foreach ($ambiltelahdibayar as $atd )


                        <tr id="sid{{ $atd->id }}">
                            <td class="text-center">
                                <input type="checkbox" name="ids" class="checkBoxClass" value="{{ $atd->id }}">
                            </td>
                            <td>{{ ($loop->index)+1 }}</td>
                            <td>{{$atd->created_at}}</td>
                            <td>@currency($atd->bayar)</td>



                        </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <th></th>
                                <th width="5%" class="text-center">No</th>
                                <th>Tanggal Bayar</th>
                                <th>Bayar</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->

</div></div>
<!-- Section end -->






<!-- page body -->
@endsection
