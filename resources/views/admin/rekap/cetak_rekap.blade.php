
<html>
    <head>
        <title>Laporan Rekap</title>
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    </head>
    <body>
        <style>
            .row {
              margin-right: -15px;
              margin-left: -15px;
            }
            .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
              position: relative;
              min-height: 1px;
              padding-right: 15px;
              padding-left: 15px;
            }

            .col-lg-12 {
                width: 100%;
            }

            .text-center {
              text-align: center;
            }

            body {
              font-family: Helvetica, Arial, sans-serif;
              font-size: 12px;
              line-height: 1.42857143;
              color: #333;
              background-color: #fff;
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
