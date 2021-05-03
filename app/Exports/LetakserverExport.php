<?php

namespace App\Exports;


use App\Models\letakserver;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class LetakserverExport implements FromCollection, WithHeadings, ShouldAutoSize,WithStyles
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
            'Penanggung Jawab',
            'Koordinat',
            'Created At',
            'Update At',
        ];
    }
    public function collection()
    {
        return letakserver::all();
    }
}


