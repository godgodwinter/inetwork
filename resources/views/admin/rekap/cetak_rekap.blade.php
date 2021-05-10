
<html>
    <head>
        <title>Laporan Rekap</title>
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
            <center><h5>Laporan Rekap</h4></center>
            <br><br>

                <div class="card-block">
                    <div class="table-responsive dt-responsive">
                        <table id="dom-jqry" class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th class="text-center">NO</th>
                                    <th>NAMA</th>
                                    <th>NOMINAL</th>
                                    <th>TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td colspan="2"><b>PEMASUKAN</b></td>
                                    <td><b>@currency($totaldapat)</b></td>
                                </tr>
                                    @foreach ($dpendapatans as $ddapat)
                                    <tr>
                                        <td class="text-center">-</td>
                                        <td>{{ $ddapat->nama }}</td>
                                        <td>@currency($ddapat->nominal)</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td class="text-center">2</td>
                                    <td colspan="2"><B>PEMASUKAN INTERNET</B></td>
                                    <td><b>@currency($totaltagihans)</b></td>
                                </tr>
                                    @foreach ($dtagihans as $dtagih)
                                    <tr>
                                        <td class="text-center">-</td>
                                        <td>{{ $dtagih->nama }}</td>
                                        <td>@currency($dtagih->total_bayar)</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td class="text-center">3</td>
                                    <td colspan="2"><b>PENGELUARAN</b></td>
                                    <td><b>@currency($totalkeluar)</b></td>
                                </tr>
                                    @foreach ($dpengeluarans as $dkeluar)
                                    <tr>
                                        <td class="text-center">-</td>
                                        <td>{{ $dkeluar->nama }}</td>
                                        <td>@currency($dkeluar->nominal)</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                <tr>
                                    <td class="text-center">4</td>
                                    <td colspan="2"><b>PEMASUKAN BERSIH</b></td>
                                    <td><b>@currency($totaldapat+$totaltagihans-$totalkeluar)</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
    </body>
    </html>
