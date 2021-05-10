<html>
    <head>
        <title>Laporan Pemasukan dan Pengeluaran</title>
                <style type="text/css">
            table tr td,
            table tr th{
                font-size: 12px;
                font-family: Georgia, 'Times New Roman', Times, serif;
            }
            td{
                height:10px;
                padding-left: 5px;
                padding-right: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
            }
            body {
                font-size: 12px;
                font-family:Georgia, 'Times New Roman', Times, serif;
                }
            h1 h2 h3 h4 h5{
                line-height: 1.2;
            }
            .spa{
              letter-spacing:3px;
            }
            table{
    width:100%;
    border-collapse:collapse;
    font-size:12px;
    }
        </style>
    </head>
    <body>

    <table width="100%" border="0">
        <tr>
            <td width="13%" align="right"><</td>
            <td width="80%" align="center"><p><b>
                <font size="28px"></font><br>
                <font size="20px">LAPORAN PEMASUKAN DAN PENGELUARAN <br>BULAN {{ strtoupper(\Carbon\Carbon::parse($blnthn)->translatedFormat('F Y'))}}<br></p>
            </td>
            <td widht="7%"></td>
        </tr>
    </table>


    <table width="100%" border="1">
        <tr>
            <th class="text-center">NO</th>
            <th>NAMA</th>
            <th>NOMINAL</th>
            <th>TOTAL</th>
        </tr>
        <tr>
            <td align="center">1</td>
            <td colspan="2"><b>PEMASUKAN</b></td>
            <td  align="right"><b>@currency($totaldapat)</b></td>
        </tr>
            @foreach ($dpendapatans as $ddapat)
            <tr>
                <td align="center">-</td>
                <td>&nbsp;{{ $ddapat->nama }}</td>
                <td  align="right">@currency($ddapat->nominal)</td>
                <td></td>
            </tr>
            @endforeach
        <tr>
            <td  align="center">2</td>
            <td colspan="2"><B>PEMASUKAN INTERNET</B></td>
            <td align="right"><b>@currency($totaltagihans)</b></td>
        </tr>
            @foreach ($dtagihans as $dtagih)
            <tr>
                <td  align="center">-</td>
                <td>{{ $dtagih->nama }}</td>
                <td align="right">@currency($dtagih->total_bayar)</td>
                <td></td>
            </tr>
            @endforeach
        <tr>
            <td  align="center">3</td>
            <td colspan="2"><b>PENGELUARAN</b></td>
            <td align="right"><b>@currency($totalkeluar)</b></td>
        </tr>
            @foreach ($dpengeluarans as $dkeluar)
            <tr>
                <td  align="center">-</td>
                <td>{{ $dkeluar->nama }}</td>
                <td align="right">@currency($dkeluar->nominal)</td>
                <td></td>
            </tr>
            @endforeach
        <tr>
            <td  align="center">4</td>
            <td colspan="2"><b>PEMASUKAN BERSIH</b></td>
            <td align="right"><b>@currency($totaldapat+$totaltagihans-$totalkeluar)</b></td>
        </tr>
    </table><br>

    </body>
    </html>
