<html>
    <head>
        <title>Laporan Pengeluaran</title>
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
                <font size="20px">LAPORAN PENGELUARAN BULAN
                    {{ strtoupper(\Carbon\Carbon::parse($blnthn)->translatedFormat('F Y'))}}<br></p>
            </td>
            <td widht="7%"></td>
        </tr>
    </table>

    <table width="100%" border="1">

        <tr>
        <th align="center">No</th>
        <th>Nama</th>
        <th align="center">Nominal</th>
        <th align="center">Tanggal</th>
        <th align="center">Kategori</th>

    </tr>
        @foreach ($datas as $data)
            @php

                    $nominal=$data->nominal;

                    // $newDate = date("d-m-Y", strtotime($data->tgl));
                    $tgl=$data->tgl;


            @endphp

        <tr>
            <td align="center">{{ ($loop->index)+1 }} </td>
            <td>{{$data->nama}}</td>
            <td align="center">@currency($nominal)</td>
            <td align="center">
                {{ \Carbon\Carbon::parse($tgl)->translatedFormat('d F Y')}}
            </td>
            <td align="center">
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
<br><br>
Keterangan :
<br><br><br>
<table width="100%" border="0">
    <tr>
        <th width="3%"></th>
        <th width="60%" align="left">
            1. Jumlah Pengeluaran : <b>{{ $jml }}<b><br>
            2. Total Pengeluaran :  <b>@currency($total)</b><br>

        </th>

        <th width="34%"></th>


        <th width="3%"></th>

    </tr>
</table>

</body>
</html>
