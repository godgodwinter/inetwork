<?php

namespace App\Exports;


use App\Models\pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class PengeluaranExport implements FromCollection, WithHeadings, ShouldAutoSize,WithStyles
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
            'Nominal',
            'Tanggal',
            'Jenis Pendapatan ID',
            'Created At',
            'Update At',
            'Jenis pengeluaran Nama'
        ];
    }
    public function collection()
    {
        return pengeluaran::all();
    }
}


