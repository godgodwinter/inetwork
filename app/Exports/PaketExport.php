<?php

namespace App\Exports;


use App\Models\paket;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class PaketExport implements FromCollection, WithHeadings, ShouldAutoSize,WithStyles
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
            'ID',
            'Nama.',
            'Harga',
            'Kecepatan',
            'Created At',
            'Update At',
        ];
    }
    public function collection()
    {
        // return pelanggan::all();
        $datas=DB::table('paket')->select('id', 'nama' ,'harga', 'kecepatan', 'created_at', 'updated_at')->get();
        // dd($datas);
        return  $datas;
    }
}


