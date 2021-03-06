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
                        <a href="#"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="..">Kembali</a> </li>
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
    <!-- tambah -->
    <div class="card" id="add" >

        <div class="card-block">
            <div class="card-body">
                <form action="/admin/paket/{{$data->id}}" method="post">
                    @method('put')
                    @csrf
                    {{-- <h5>@yield('title')</h5> --}}
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama @yield('title')  (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="Contoh : Paket A " value="{{ $data->nama }}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-harga2">Harga  (*</label> -
                                    <b><label class="form-control-label" for="input-kecepatan" id="input-harga-label">@currency($data->harga)</label></b>
                                    <input type="number" name="harga" id="input-harga"
                                        class="form-control form-control-alternative  @error('harga') is-invalid @enderror"
                                        placeholder="Contoh : 150000" value="{{ $data->harga }}" required>
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
                                        placeholder="Contoh : 5 " value="{{ $data->kecepatan }}" required>

                                    @error('kecepatan')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                    <hr class="my-4" />
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Aksi</h6>
                    <div class="pl-lg-4">
                        <div class="row">
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
<!-- tambah end -->
</div>
<!-- Section end -->

<!-- page body -->
@endsection
