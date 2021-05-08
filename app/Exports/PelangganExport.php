<?php

namespace App\Exports;


use App\Models\pelanggan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Support\Facades\DB;

class PelangganExport implements FromCollection, WithHeadings, ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],


        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NIK',
            'Nama',
            'Alamat',
            'HP',
            'Tanggal Bergabung',
            'PPOE User',
            'PPOE Password',
            'PPOE Status',
            'ID Paket',
            'Status Langganan',
            'Letak Server',
            'Koordinat Rumah',
            'Nama Paket',
            'Nama Letak Server',
            'Koordinat Letak Server',
            'Harga Paket',
            'Kecepatan Paket',
            'Created At',
            'Update At',
        ];
    }
    public function collection()
    {
        // return pelanggan::all();
        return  $users = DB::table('pelanggan')->select('id', 'nik', 'nama' , 'alamat', 'hp', 'tgl_gabung', 'user_ppoe', 'pass_ppoe', 'status_ppoe', 'paket_id', 'status_langganan', 'letakserver_id', 'kordinat_rumah', 'paket_nama' , 'letakserver_nama' ,'letakserver_koordinat','paket_harga','paket_kecepatan', 'created_at', 'updated_at')->get();
    }
}


