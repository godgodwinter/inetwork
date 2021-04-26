@extends('admin.main')

@section('title','Inventaris')

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
<div class="page-body"id="datatable" >
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="card-header"><div class="row">
            <div class="col-xl-6 col-md-12">
                <a href="#add" class="btn btn-sm btn-success">TAMBAH</a>
                <a href="#jenisalat" class="btn btn-sm btn-success">JENIS ALAT</a>
            </div>
            <div class="col-xl-6 col-md-12 d-flex flex-row-reverse">
                <a href="import" class="btn btn-sm  btn-primary" target="_blank">IMPORT</a>
                <a href="export" class="btn btn-sm  btn-primary" target="_blank">EXPORT</a>
                <a href="cetak" class="btn btn-sm  btn-primary" target="_blank">CETAK PDF</a>
            </div>

        </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Letak Barang</th>
                            <th>Jenis Alat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            @php

                                    $harga=$data->harga;

                            @endphp

                        <tr>
                            <td>{{ ($loop->index)+1 }} </td>
                            <td>{{$data->nama}}</td>
                            <td>@currency($harga)</td>
                            <td>{{$data->letak}}</td>
                            <td>
                                <?php
                                $nama_jenisalat="-";
                                $data2s = DB::table('jenisalat')->where('id',$data->jenisalat_id)->get();
                            ?>
                                @foreach($data2s as $d2)
                                    @php
                                         $nama_jenisalat=$d2->nama;
                                    @endphp
                                @endforeach

                                {{$nama_jenisalat}}
                            </td>

                            <td>
                                <a class="btn btn-warning btn-sm btn-outline-warning"
                                    href="/admin/inventaris/{{$data->id}}/edit"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>
                                <form action="/admin/inventaris/{{$data->id}}" method="post" class="d-inline">
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
                                <th>Letak Barang</th>
                                <th>Jenis Alat</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->
    <!-- tambah -->
    <div class="card" id="add" >
        <div class="card-header">
            <a href="#datatable" class="btn btn-sm btn-success">DATATABLE</a>
        </div>
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/inventaris " method="post">
                    @csrf
                    <h5>Tambah @yield('title')</h5>
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Barang  (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="" value="{{old('nama')}}" required>
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
                                    <label class="form-control-label" for="input-letak">Letak Barang  (*</label>
                                    <input type="text" name="letak" id="input-letak"
                                        class="form-control form-control-alternative  @error('letak') is-invalid @enderror"
                                        placeholder="" value="{{old('letak')}}" required>

                                    @error('letak')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-xl-6 m-b-30">
                                <label class="form-control-label" for="input-jk">Pilih Jenis Barang  (*</label>
                                <select name="jenisalat_id" id="input-jenisalat_id"
                                    class="form-control form-control-info  @error('jenisalat_id') is-invalid @enderror"
                                    required>
                            <?php
                                $data2s = DB::table('jenisalat')->get();
                            ?>
                                @foreach($data2s as $d2)
                                        <option value="{{ $d2->id }}">{{ $d2->nama }}</option>
                                @endforeach
                                        </select> @error('jenisalat_id')<div class="invalid-feedback"> {{$message}}
                                        </div>
                                @enderror
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





 <!-- ticket and update start -->
 <div class="row">
 <div class="col-xl-6 col-md-12" id="jenisalat">
    <div class="card table-card">
        <div class="card-header">
            <h5>Jenis Alat</h5>
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
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datadetails as $dd)
                         <tr>
                            <td><label class="label label-success">{{ ($loop->index)+1 }} </label></td>
                            <td>{{$dd->nama}}</td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modaleditdetail{{$dd->id}}">
                                    <span class="pcoded-micon"> <i class="feather icon-edit"></i></span>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modaleditdetail{{$dd->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit {{$dd->nama}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        ...
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                <form action="/admin/jenisalat/{{$dd->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm  btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-12">
    <div class="card latest-update-card">
        <div class="card-header">
            <h5>Latest Updates</h5>
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
            <div class="latest-update-box">
                <div class="row p-t-20 p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">2 hrs ago</p>
                        <i class="feather icon-twitter bg-info update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>+ 1652 Followers</h6>
                        <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
                    </div>
                </div>
                <div class="row p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">4 hrs ago</p>
                        <i class="feather icon-briefcase bg-simple-c-pink update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>+ 5 New Products were added!</h6>
                        <p class="text-muted m-b-0">Congratulations!</p>
                    </div>
                </div>
                <div class="row p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">1 day ago</p>
                        <i class="feather icon-check bg-simple-c-yellow  update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>Database backup completed!</h6>
                        <p class="text-muted m-b-0">Download the <span class="text-c-blue">latest backup</span>.</p>
                    </div>
                </div>
                <div class="row p-b-0">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">2 day ago</p>
                        <i class="feather icon-facebook bg-simple-c-green update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>+2 Friend Requests</h6>
                        <p class="text-muted m-b-10">This is great, keep it up!</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td class="b-none">
                                        <a href="#!" class="align-middle">
                                       <img src="../files/assets/images/avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                       <div class="d-inline-block">
                                           <h6>Jeny William</h6>
                                           <p class="text-muted m-b-0">Graphic Designer</p>
                                       </div>
                                   </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="b-none">
                                        <a href="#!" class="align-middle">
                                       <img src="../files/assets/images/avatar-1.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                       <div class="d-inline-block">
                                           <h6>John Deo</h6>
                                           <p class="text-muted m-b-0">Web Designer</p>
                                       </div>
                                   </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#!" class="b-b-primary text-primary">View all Projects</a>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ticket and update end -->

<!-- page body -->
@endsection
