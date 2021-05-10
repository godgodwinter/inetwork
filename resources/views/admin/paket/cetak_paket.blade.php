<html>
    <head>
        <title>Laporan Paket</title>
                <style type="text/css">
            table tr td,
            table tr th{
                font-size: 12px;
                font-family: Georgia, 'Times New Roman', Times, serif;
            }
            td{
                height:10px;
                padding-left: 5px;
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
                <font size="20px">PAKET INTERNET<br></p>
            </td>
            <td widht="7%"></td>
        </tr>
    </table>

    <table width="100%" border="1">

        <tr>
            <th align="center">No</th>
            <th>Nama</th>
            <th align="center">Harga</th>
            <th align="center">Kecepatan</th>

        </tr>

                            @foreach ($paket as $data)
                                @php

                                        $harga=$data->harga;

                                @endphp

                            <tr>
                                <td align="center">{{ ($loop->index)+1 }} </td>
                                <td>Paket {{$data->nama}}</td>
                                <td align="center">@currency($harga)</td>
                                <td align="center">{{$data->kecepatan}} Mbps</td>


                            </tr>
                            @endforeach

    </table>

</body>
</html>
