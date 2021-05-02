
        <html>
            <head>
                <title>Laporan Pelanggan</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            </head>
            <body>
                <style type="text/css">
                    table tr td,
                    table tr th{
                        font-size: 9pt;
                    }
                </style>
                    <br><br>
                    <center><h5>Laporan Pelanggan</h4></center>
                    <br><br>

                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table  table-bordered nowrap">
                                <thead>
                                    <tr>

                                        <th>NIK - Nama</th>
                                        <th>No WA</th>
                                        <th>Tanggal Gabung</th>
                                        <th>Status Langganan</th>
                                        <th>Paket</th>

                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $status_langganan='Non-Aktif';
                                @endphp
                                    @foreach ($pelanggan as $data)
                                        @php

                                                if($data->status_langganan=='Aktif'){
                                                    $status_langganan='Aktif';
                                                }else{
                                                    $status_langganan='Non-Aktif';
                                                }

            // dd($tgl);
            // {{ \Carbon\Carbon::parse($user->from_date)->format('d/m/Y')}}

                                        @endphp

                                    <tr>

                                        <td>{{$data->nik}} - {{$data->nama}}</td>
                                        <td>{{$data->hp}}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($data->tgl_gabung)->translatedFormat('d F Y')}}
                                        </td>
                                        <td>{{$status_langganan}}</td>
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
                                                    echo $data->paket_nama;
                                                }
                                            @endphp
                                        </td>


                                    </tr>
                                    @endforeach

                            </table>
                        </div>
                    </div>

            </body>
            </html>
