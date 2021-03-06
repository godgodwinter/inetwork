<?php

namespace App\Exports;


use App\Models\inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class InventarisExport implements FromCollection, WithHeadings, ShouldAutoSize,WithStyles
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
            'Nama.',
            'Harga',
            'Letak Barang',
            'Jenis Alat ID',
            'Created At',
            'Update At',
            'Jenis Alat Nama',
            'Tanggal'
        ];
    }
    public function collection()
    {
        return inventaris::all();
    }
}


