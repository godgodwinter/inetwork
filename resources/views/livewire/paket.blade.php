<div class="page-wrapper">

    {{-- <div>
        <input type="text" wire:model="name">

        Hi! My name is {{ $name }}
    </div> --}}

        @section('title','Paket Internet')

<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>@yield('title')</h4>
                    <span>Halaman Mastering @yield('title')</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="index.html"> <i class="feather icon-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">@yield('title')</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Section start -->
<div class="page-body">
    <!-- DOM/Jquery table start -->
    <div class="card">
        <div class="card-header">
            <h5>Data @yield('title')</h5>
        </div>

        <div class="card-block">
            <div class="table-responsive dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Paket Internet</th>
                            <th>Harga</th>
                            <th>Kecepatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pakets as $data)


                        <tr>
                            <td>{{ ($loop->index)+1 }} </td>
                            <td>{{$data->nama}}</td>
                            <td>@currency($data->harga)</td>
                            <td>{{$data->kecepatan}} Mbps</td>

                            <td>

                                <a class="btn btn-warning btn-outline-warning"
                                    href="/admin/data/{{$data->id}}/edit"><span class="pcoded-micon"> <i
                                            class="feather icon-edit"></i></span></a>

                                <button wire:click="hapusdata({{$data->id}}"
                                class="btn btn-danger">Hapus ({{$data->id}})</button>
                                <button wire:click="edit({{$data->id}})" class="btn btn-sm btn-outline-danger py-0">Edit</button> |
                                <button wire:click="destroy({{$data->id}})" class="btn btn-sm btn-outline-danger py-0">Delete</button>

                                <form action="/admin/data/{{$data->id}}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-outline-warning"
                                        onclick="return  confirm('Anda yakin menghapus data ini? Y/N')"><span
                                            class="pcoded-micon"> <i class="feather icon-delete"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>

                            <th>Nama paket</th>
                            <th>Harga</th>
                            <th>Kecepatan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- DOM/Jquery table end -->
    <!-- tambah -->
    <div class="card">
        <div class="card-block">
            <div class="card-body">
                <form action="/admin/kriteria " method="post">
                    @csrf
                    <h5>Tambah @yield('title')</h5>
                    <span>&nbsp; </span>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Kriteria (*</label>
                                    <input type="text" name="nama" id="input-nama"
                                        class="form-control form-control-alternative  @error('nama') is-invalid @enderror"
                                        placeholder="Contoh : Tanggungan Keluarga " value="{{old('nama')}}" required>
                                    @error('nama')<div class="invalid-feedback"> {{$message}}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-telp">nilai *)</label>
                                    <input type="text" name="nilai" id="input-telp"
                                        class="form-control form-control-alternative  @error('nilai') is-invalid @enderror"
                                        placeholder="Contoh : 5 " value="{{old('nilai')}}" required>
                                    @error('nilai')<div class="invalid-feedback"> {{$message}}</div>
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

</div>
<!-- wrapper end -->

