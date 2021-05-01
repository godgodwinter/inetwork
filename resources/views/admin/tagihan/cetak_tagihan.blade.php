
<html>
    <head>
        <title>Laporan Tagihan</title>
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
            <center><h5>Laporan Tagihan</h4></center>
            <br><br>

                <div class="card-block">
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK - Nama</th>
                                    <th>Paket</th>
                                    <th>Total Bayar</th>
                                    <th>No WA</th>
                                    <th>Tanggal Bayar</th>

                                </tr>
                            </thead>
                            <tbody>
                            @php
                            $status_langganan='Non-Aktif';
                            @endphp
                                @foreach ($tagihan as $data)
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
                                    <td>
                                        {{ ($loop->index)+1 }}

                                    </td>
                                    <td>{{$data->nik}} - {{$data->nama}}</td>
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
                                        <td>
                                            @currency($data->total_bayar)
                                        </td>
                                    <td>
                                        @php
                                        //cari apakah nik pelanggan ada
                                        $jmlnik = DB::table('pelanggan')
                                        ->where('nik', '=', $data->nik)
                                        ->count();


                                            if (($jmldata)<1){
                                        @endphp
                                        <span class="pcoded-micon"> <i
                                                    class="feather icon-alert-triangle"></i></span>
                                        @php
                                            }else{
                                                $jmlnik = DB::table('pelanggan')
                                                ->where('nik', '=', $data->nik)->get();
                                                foreach ($jmlnik as $jn) {
                                                    echo $jn->hp;
                                                }

                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($data->tgl_bayar)->translatedFormat('d F Y')}}
                                    </td>



                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
                </div>
    </body>
    </html>
