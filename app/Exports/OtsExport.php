<?php

namespace App\Exports;

use App\Models\Ot;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Collection;
// use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

// class OtsExport implements FromCollection, ShouldAutoSize
// class OtsExport implements FromQuery
// class OtsExport implements FromArray
class OtsExport implements FromCollection, WithHeadings, WithMapping, WithCalculatedFormulas
{

    use Exportable;

    protected $ots;

    public function __construct($ots)
    {
        $this->ots = $ots;
        // dd($this->ots);
        
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Nro. OT',
            'Cliente'
        ];

    }

    public function map($ots): array
    {
        return [
            $ots['fecha_alta'],
            $ots['numero'],
            $ots['cliente']['razonsocial'],
        ];
    }

    public function collection()
    {
        // return Ot::all();
        // return new Collection($this->ots);
        // dd($this->ots);
        return $this->ots;

    }

    // public function array():array
    // {
    //     return $this->ots;
    // }

    // public function query() 
    // {
    //     // return Ot::query();
    // }

    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     // return Ot::all();
    //     return new Collection($this->ots);

    // }
}
