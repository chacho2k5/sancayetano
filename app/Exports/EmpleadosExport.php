<?php

namespace App\Exports;

use App\Models\Empleado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;


class EmpleadosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    use Exportable;

    
    public function headings(): array
    {
        return [
            'Id',
            'Apellido',
            'Nombres',
            'Dni',
            'Telofono',
            'Email',
            'Direccion'
        
        ];


    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
         //       $event->writer->setCreator('Patrick');
            },
          //  AfterSheet::class    => function(AfterSheet $event) {
          //      $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
                Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
                    $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        
                },
                )
         ];
    }

    public function collection()
    {
        return Empleado::all();
    }
}


