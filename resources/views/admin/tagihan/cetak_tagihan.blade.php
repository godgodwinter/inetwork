<html>
    <head>
        <title>Laporan Tagihan</title>
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
                <font size="20px">LAPORAN Tagihan<br></p>
            </td>
            <td widht="7%"></td>
        </tr>
    </table>

    <table width="100%" border="1">

        <tr>
            <th align="center">No</th>
            <th>NIK - Nama</th>
            <th align="center">Paket</th>
            <th align="center">Total Bayar</th>
            <th align="center">No WA</th>
            <th align="center">Tanggal Bayar</th>

        </tr>
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
            <td align="center">
                {{ ($loop->index)+1 }}

            </td>
            <td>{{$data->nik}} - {{$data->nama}}</td>
            <td align="center">
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
                <td align="center">
                    @currency($data->total_bayar)
                </td>
            <td align="center">
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
            <td align="center">
                {{ \Carbon\Carbon::parse($data->tgl_bayar)->translatedFormat('d F Y')}}
            </td>



        </tr>
        @endforeach
</table>
</body>
</html>
