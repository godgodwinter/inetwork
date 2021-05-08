@extends('admin.layouts.nav1')

@section('title','Import Special')

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
                            data-target="#import">IMPORT PELANGGAN GET DATA PAKET INTERNET</a>



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
                                            action="{{ route('importpelanggangetinet') }}" class="form-horizontal" method="post"
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

                        <a href="import" class="btn btn-sm  btn-primary" data-toggle="modal"
                        data-target="#import-importpembayaranwhereniknama">IMPORT PEMBAYARAN BERDASARKAN NIK NAMA HARGA</a>



                    <!-- Modal -->
                    <div class="modal fade" id="import-importpembayaranwhereniknama" tabindex="-1" role="dialog"
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
                                        action="{{ route('importpembayaranwhereniknama') }}" class="form-horizontal" method="post"
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



                    </div>
                    <div class="col-xl-6 col-md-6 d-flex flex-row-reverse">
                        {{-- <a href="#" class="btn btn-sm  btn-danger" id="deleteAllSelectedRecord">HAPUS TERPILIH</a>&nbsp;
                        <a href="#add" class="btn btn-sm btn-secondary">TAMBAH</a> --}}
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

                </div>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->
    <!-- tambah -->

<!-- tambah end -->
</div>
<!-- Section end -->

<!-- page body -->
@endsection
