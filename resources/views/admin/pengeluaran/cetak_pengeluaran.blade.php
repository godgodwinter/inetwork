
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
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengeluaran as $data)
                                    @php

                                            $nominal=$data->nominal;

                                            // $newDate = date("d-m-Y", strtotime($data->tgl));
                                            $tgl=$data->tgl;
        // dd($tgl);
        // {{ \Carbon\Carbon::parse($user->from_date)->format('d/m/Y')}}

                                    @endphp

                                <tr>
                                    <td>{{ ($loop->index)+1 }} </td>
                                    <td>{{$data->nama}}</td>
                                    <td>@currency($nominal)</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($tgl)->translatedFormat('d F Y')}}
                                    </td>
                                    <td>
                                        <?php
                                        $namakategori=$data->jenispengeluaran_nama;
                                        $data2s = DB::table('jenispengeluaran')->where('id',$data->jenispengeluaran_id)->get();
                                    ?>
                                        @foreach($data2s as $d2)
                                            @php
                                                 $namakategori=$d2->nama;
                                            @endphp
                                        @endforeach

                                        {{$namakategori}}
                                    </td>

                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
                </div>
    </body>
    </html>
