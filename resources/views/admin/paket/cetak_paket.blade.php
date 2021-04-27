
<html>
<head>
	<title>Laporan Paket Internet</title>
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
		<center><h5>Laporan Paket Internet</h4></center>
        <br><br>

            <div class="card-block">
                <div class="table-responsive dt-responsive">
                    <table id="dom-jqry" class="table table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Kecepatan</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paket as $data)
                                @php

                                        $harga=$data->harga;

                                @endphp

                            <tr>
                                <td>{{ ($loop->index)+1 }} </td>
                                <td>{{$data->nama}}</td>
                                <td>@currency($harga)</td>
                                <td>{{$data->kecepatan}} Mbps</td>


                            </tr>
                            @endforeach

                    </table>
                </div>
            </div>
            </div>
</body>
</html>
