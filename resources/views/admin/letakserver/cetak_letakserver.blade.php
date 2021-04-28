
        <html>
            <head>
                <title>Laporan Letak Server</title>
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
                    <center><h5>Laporan Letak Server</h4></center>
                    <br><br>

                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Penanggung Jawab</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($letakserver as $data)
                                  <tr>
                                        <td>{{ ($loop->index)+1 }} </td>
                                        <td>{{$data->nama}}</td>
                                        <td>{{$data->penanggungjawab}}</td>


                                    </tr>
                                    @endforeach

                            </table>

                            </div>
                        </div>

            </body>
            </html>
