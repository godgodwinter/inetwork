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
            'Panggilan',
            'Alamat',
            'HP',
            'ID Paket',
            'Nama Paket',
            'Harga Paket',
            'Kecepatan Paket',
            'Tanggal Bergabung',
            'Status Langganan',
            'ID Letak Server',
            'Nama Letak Server',
            'Koordinat Letak Server',
            'Koordinat Rumah',
            'Created At',
            'Update At',
            'PPOE User',
            'PPOE Password',
            'PPOE Status',
        ];
    }
    public function collection()
    {
        // return pelanggan::all();
        return  $users = DB::table('pelanggan')->select('id', 'nik', 'nama' ,'panggilan', 'alamat', 'hp', 'paket_id', 'paket_nama','paket_harga','paket_kecepatan', 'tgl_gabung', 'status_langganan', 'letakserver_id' , 'letakserver_nama' ,'letakserver_koordinat', 'kordinat_rumah', 'created_at', 'updated_at', 'user_ppoe', 'pass_ppoe', 'status_ppoe')->get();
    }
}


