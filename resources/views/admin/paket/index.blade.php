@extends('admin.layouts.nav1')

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
    integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
    crossorigin="anonymous"></script>
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
    <div class="col-xl-12 col-md-12 page-body" id="datatable">
        <!-- DOM/Jquery table start -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12">
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
                                        <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
                                            action="{{ route('importpaket') }}" class="form-horizontal" method="post"
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

                        <a href="{{ route('exportpaket', 'xlsx') }}" class="btn btn-sm  btn-primary"
                            target="_blank"><i class="feather icon-download"></i>EXPORT</a>
                        <a href="cetak/cetak_paket" class="btn btn-sm  btn-primary" target="_blank"><i class="feather icon-file-text"></i>PDF</a>

                    </div>
                    <div class="col-xl-12 col-md-12 mt-1 d-flex">
                        <a href="#" class="btn btn-sm  btn-danger" id="deleteAllSelectedRecord"
                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><i class="feather icon-x"></i>HAPUS TERPILIH</a>&nbsp;

                        <a href="#add" class="btn btn-sm btn-secondary"><i class="feather icon-plus"></i>TAMBAH</a>&nbsp;
                        <form action="{{ route('paket.empty') }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button  class="btn btn-sm  btn-danger"
                                onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><i
                                        class="feather icon-trash-2"></i> EMPTY / RESET ID</button>
                        </form>
                      &nbsp;
                    </div>
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
                        url:"{{ route('paket.deleteSelected') }}",
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
                                    <input type="checkbox" id="chkCheckAll"> <label for="chkCheckAll">All</label>
                                </th>
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

                            <tr id="sid{{ $data->id }}">
                                <td class="text-center">
                                    <input type="checkbox" name="ids" class="checkBoxClass" value="{{ $data->id }}">
                                </td>
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
                                                class="pcoded-micon"> <i
                                                    class="feather icon-delete"></i></span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        <tfoot>
                            <tr>
                                <th></th>
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
                <div class="col-xl-12 col-md-12">
    <div class="card" id="add">
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
                                        <label class="form-control-label" for="input-nama">Nama @yield('title')
                                            (*</label>
                                        <input type="text" name="nama" id="input-nama"
                                            class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                            placeholder="Contoh : Paket A " value="{{old('nama')}}" required>
                                        @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-harga2">Harga (*</label> -
                                        <b><label class="form-control-label" for="input-kecepatan"
                                                id="input-harga-label">Rp. 0 ,00</label></b>
                                        <input type="number" name="harga" id="input-harga"
                                            class="form-control form-control-alternative  @error('harga') is-invalid @enderror"
                                            placeholder="Contoh : 150000" value="{{old('harga')}}" required>
                                        @error('harga')<div class="invalid-feedback"> {{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    var format = function (num) {
                                        var str = num.toString().replace("$", ""),
                                            parts = false,
                                            output = [],
                                            i = 1,
                                            formatted = null;
                                        if (str.indexOf(".") > 0) {
                                            parts = str.split(".");
                                            str = parts[0];
                                        }
                                        str = str.split("").reverse();
                                        for (var j = 0, len = str.length; j < len; j++) {
                                            if (str[j] != ",") {
                                                output.push(str[j]);
                                                if (i % 3 == 0 && j < (len - 1)) {
                                                    output.push(".");
                                                }
                                                i++;
                                            }
                                        }
                                        formatted = output.reverse().join("");
                                        return ("Rp" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ",-"));
                                    };
                                    $(document).ready(function () {
                                        $("#input-harga").on('keyup', function () {
                                            // alert("oops!");
                                            $('#input-harga-label:last').text(format($(this).val()));
                                        });

                                    });

                                </script>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-kecepatan">Kecepatan (*</label>
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
