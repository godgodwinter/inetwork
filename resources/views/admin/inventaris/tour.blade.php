@extends('admin.layouts.nav2')

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

@endsection <!-- Page-body start -->

@section('headernav')
 <!-- Page-header start -->
 <div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">

            </div>
        </div>
<!-- Page-header end -->
<div class="col-xl-12 col-md-12">
            <div class="card"
            data-intro="Tambahkan Kategori Dahulu!"" data-step="1"
            data-hint="Hello step one!">
                <div class="card-header">
                    <h5 class="label label-info">TAMBAH JENIS ALAT DAHULU!</h5>
                </div>
                <div class="card-block bg-c-white">
                    <div class="col-xl-6 col-md-6">
       <div class="card latest-update-card">

           <div class="card-block">

               <form action="/admin/jenisalat" method="post">
                   @csrf
               <div class="pl-lg-4">
                   <div class="row">
                       <div class="col-lg-12">
                           <div class="form-group">
                               <label class="form-control-label " for="input-nama">Nama Jenis Alat(*</label>
                               <input type="text" name="nama" id="input-nama"
                                   class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                   placeholder="" value="{{old('nama')}}" required>
                               @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                               @enderror
                           </div>
                       </div>
                   </div>
               </div>
               <div class="text-center">
                                   <button type="Simpan" class="btn btn-success">Simpan</button>
               </div>

               </form>

           </div>
       </div>
   </div>
                </div>
                <div class="card-footer">
                    {{-- <h6 class="text-muted m-b-30 m-t-15">Total Pembayaran Tagihan Internet</h6> --}}
                    <div class="row text-center">

                    </div>
                </div>
            </div>
        </div>



@endsection
