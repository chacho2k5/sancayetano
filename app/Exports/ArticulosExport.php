<?php

namespace App\Exports;

use App\Models\Articulo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;


class ArticulosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{

    use Exportable;

    
    public function headings(): array
    {
        return [
            'Orden',
            'Codigo',
            'Descripcion',
            'Categoria',
            'Delicado',
        ];


    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function(BeforeExport $event) {
         //       $event->writer->setCreator('Patrick');
            },
               Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
                    $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
        
                },
           )
         ];
    }

    public function collection()
    {
        return Articulo::all();
    }
}
