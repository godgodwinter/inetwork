@extends('admin.main')

@section('title','Paket Internet')

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
 <div class="row">
    <div class="col-xl-8 col-md-12 page-body" id="datatable" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <a href="import" class="btn btn-sm  btn-primary" target="_blank">IMPORT</a>
                    <a href="export" class="btn btn-sm  btn-primary" target="_blank">EXPORT</a>
                    <a href="cetak/cetak_paket" class="btn btn-sm  btn-primary" target="_blank">CETAK PDF</a>
                </div>
                <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                    <a href="#add" class="btn btn-sm btn-secondary">TAMBAH</a>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th class="text-center">Kecepatan</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            @php

                                    $harga=$data->harga;

                            @endphp

                        <tr>
                            <td class="text-center">{{ ($loop->index)+1 }} </td>
                            <td>{{$data->nama}}</td>
                            <td>@currency($harga)</td>
                            <td class="text-center">{{$data->kecepatan}} Mbps</td>

                            <td>
                                <a class="btn btn-warning btn-sm btn-outline-warning"
                                    href="/admin/paket/{{$data->id}}/edit"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>
                                <form action="/admin/paket/{{$data->id}}" method="post" class="d-inline">
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
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Kecepatan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- DOM/Jquery table end -->
    <!-- tambah -->
        <div class="col-xl-4 col-md-12">
            <div class="card  id="add" >
        <div class="card-header">
            <div class="row">

                <div class="col-xl-6 col-md-6">

                    <h5 class="label label-success">TAMBAH</h5>
                </div>

                <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                    <a href="#datatable" class="btn btn-sm btn-secondary">DATATABLE</a>

                </div>
            </div>

            <div class="card-body">
                <form action="/admin/paket " method="post">
                    @csrf
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama @yield('title')  (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="Contoh : Paket A " value="{{old('nama')}}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-harga2">Harga  (*</label> -
                                    <b><label class="form-control-label" for="input-kecepatan" id="input-harga-label">Rp. 0 ,00</label></b>
                                    <input type="number" name="harga" id="input-harga"
                                        class="form-control form-control-alternative  @error('harga') is-invalid @enderror"
                                        placeholder="Contoh : 150000" value="{{old('harga')}}" required>
                                    @error('harga')<div class="invalid-feedback"> {{$message}}</div>
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
                                $("#input-harga").on('keyup', function() {
                                    // alert("oops!");
                                    $('#input-harga-label:last').text(format($(this).val()));
                                });

                            });
                            </script>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-kecepatan">Kecepatan  (*</label>
                                    <input type="number" name="kecepatan" id="input-kecepatan"
                                        class="form-control form-control-alternative  @error('kecepatan') is-invalid @enderror"
                                        placeholder="Contoh : 5 " value="{{old('kecepatan')}}" required>

                                    @error('kecepatan')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 d-flex flex-row-reverse mt-4">
                                <div class="form-group">
                                    <button type="Simpan" class="btn btn-success">Simpan</button>
                                </div>
                            </div>

                        </div>
                    </div>


    </form>
    </div>
</div>
</div>
</div>
</div>
<!-- tambah end -->
</div>
<!-- Section end -->

<!-- page body -->
@endsection
