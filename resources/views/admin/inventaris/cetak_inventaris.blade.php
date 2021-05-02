
        <html>
            <head>
                <title>Laporan Inventaris</title>
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
                    <center><h5>Laporan Inventaris</h4></center>
                    <br><br>
                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table  table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Letak Barang</th>
                                        <th>Jenis Alat</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventaris as $data)
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
                                            $nama_jenisalat=$data->jenisalat_nama;
                                            $data2s = DB::table('jenisalat')->where('id',$data->jenisalat_id)->get();
                                        ?>
                                            @foreach($data2s as $d2)
                                                @php
                                                     $nama_jenisalat=$d2->nama;
                                                @endphp
                                            @endforeach

                                            {{$nama_jenisalat}}
                                        </td>


                                    </tr>
                                    @endforeach

                            </table>
                        </div>
                    </div>


            </body>
            </html>
