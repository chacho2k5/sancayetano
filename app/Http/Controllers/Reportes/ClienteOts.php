<?php

namespace App\Http\Controllers\Reportes;

use App\Models\Ot;
use App\Models\OtCuerpo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ClienteOts extends Controller
{
    public $header;
    public $rows;
    public $articulos;

    public $col_articulos = 2;      // Columna donde inician los articulos
    public $col_final;              // Ultima columna de articulos
    public $fil_detalle = 5;
    public $fila_detalle_final;
    public $fila_totales;       // Fila de inicio de los totales

    public $fecha_desde;
    public $cliente_id, $razonsocial;
    public $ot_id, $fecha_alta, $numero;

    public function index() {

        $this->cliente_id = 74;

        $this->header = DB::table('ots')
                ->where('ots.cliente_id', '139')
                ->join('clientes','ots.cliente_id', '=', 'clientes.id')
                ->select('ots.id','ots.fecha_alta','numero', 'razonsocial')
                ->orderBy('fecha_alta', 'desc')
                ->get();

        if (count($this->header) == 0) {
            return false;
        }

        // Id del la 1er OT
        $this->razonsocial = $this->header->value('razonsocial');

        // Para armar los encabezados de las columnas de articulos
        $this->articulos = Articulo::select('descripcion','orden')
                ->orderBy('orden', 'asc')
                ->get();
                // ->toArray();

        $this->col_final = count($this->articulos) + $this->col_articulos;

        $documento = new Spreadsheet();
        $hoja = $documento->getActiveSheet();

        // $hoja->getColumnDimension('D')->setAutoSize(true);
        // $hoja->getColumnDimension('D')->setAutoSize(true);

        // TITULO HOJA
        $hoja->setTitle($this->razonsocial);
        // ENCABEZADO HOJA
        $hoja->setCellValueByColumnAndRow(1, 1, "O3 LAVANDERIA");
        $hoja->setCellValueByColumnAndRow(1, 2, $this->razonsocial);

        // ENCABEZADOS OT CUERPO
        $fil = $this->fil_detalle - 1;
        $hoja->setCellValueByColumnAndRow(1, $fil, "FECHA");
        $hoja->setCellValueByColumnAndRow(2, $fil, "REMITO");
        $col = $this->col_articulos + 1;
        foreach ($this->articulos as $articulo) {
            $hoja->setCellValueByColumnAndRow($col, $fil, $articulo->descripcion);
            $hoja->getColumnDimensionByColumn($col)->setAutoSize(true);
            $col++;
        }

        // DETALLE
        $fil = $this->fil_detalle;
        $col = 1;
        // Ciclo para las filas - 1 fila x OT
        foreach ($this->header as $row) {
            $this->ot_id = $row->id;      // Obtengo el 1er Id de la OT
            $hoja->setCellValueByColumnAndRow($col, $fil, $row->fecha_alta);
            $hoja->setCellValueByColumnAndRow($col+1, $fil, $row->numero);

            $this->rows = DB::table('ot_cuerpos')
                ->where('ot_id', $this->ot_id)
                ->join('articulos', 'ot_cuerpos.articulo_id', 'articulos.id')
                ->select('ot_cuerpos.retira', 'articulos.orden')
                ->orderBy('articulos.orden','asc')
                ->get();

            foreach ($this->rows as $articulo) {
                $hoja->setCellValueByColumnAndRow($this->col_articulos + $articulo->orden, $fil, $articulo->retira);
            }

            $fil++;
        }
        $this->fila_detalle_final = $fil-1;
        $fil++;

        $this->fila_totales = $fil;
        $hoja->mergeCellsByColumnAndRow(1,$fil,2,$fil);
        $hoja->setCellValueByColumnAndRow(1, $fil, "Total de Unidades");

        // $col = $this->col_articulos + 1;
        // foreach ($this->articulos as $articulo) {
        for($col = $this->col_articulos + 1; $col <= $this->col_final; $col++) {            
            $hoja->setCellValueByColumnAndRow($col, $this->fila_totales, "=SUM({$hoja->getCellByColumnAndRow($col,$this->fil_detalle)->getCoordinate()}:{$hoja->getCellByColumnAndRow($col,$this->fila_detalle_final)->getCoordinate()})");
            // dd($hoja->getCellByColumnAndRow($col, $this->fila_totales)->getCalculatedValue());
            if($hoja->getCellByColumnAndRow($col, $this->fila_totales)->getCalculatedValue() == 0) {
                $hoja->getColumnDimensionByColumn($col)->setVisible(false);
            }
            // $col++;
        }

        $hoja->mergeCellsByColumnAndRow(1,$fil+1,2,$fil+1);
        $hoja->setCellValueByColumnAndRow(1, $fil+1, "Precio x Unidad");
        // Aplico el formato $#.## a un rango de celdas (toda la fila)
        $col = $this->col_articulos + 1;
        $hoja->getStyleByColumnAndRow($col, $fil+1,$this->col_final,$fil+1)->getNumberFormat()->setFormatCode('$ #,##0.00');


        $hoja->mergeCellsByColumnAndRow(1,$fil+2,2,$fil+2);
        $hoja->setCellValueByColumnAndRow(1, $fil+2, "TOTAL");
        // TOTAL = CANT. UNIDADES * PRECIO x UNIDAD
        // $col = $this->col_articulos + 1;
        // foreach ($this->articulos as $articulo) {
        for($col = $this->col_articulos + 1; $col <= $this->col_final; $col++) {            
            $hoja->setCellValueByColumnAndRow($col, $this->fila_totales+2, "=({$hoja->getCellByColumnAndRow($col,$this->fila_totales)->getCoordinate()} * {$hoja->getCellByColumnAndRow($col,$this->fila_totales+1)->getCoordinate()})");
            // $hoja->getStyleByColumnAndRow($col, $this->fila_totales+2)->getNumberFormat()->setFormatCode('$ #,##0.00');
        }
        // Aplico el formato $#.## a un rango de celdas (toda la fila)
        $col = $this->col_articulos + 1;
        $hoja->getStyleByColumnAndRow($col, $this->fila_totales+2,$this->col_final,$this->fila_totales+2)->getNumberFormat()->setFormatCode('$ #,##0.00');
        
        // TOTAL GRAVADO
        $col = $this->col_articulos + 1;
        $hoja->mergeCellsByColumnAndRow(1,$fil+4,2,$fil+4);
        $hoja->setCellValueByColumnAndRow(1, $fil+4, "Total Gravado");
        $hoja->setCellValueByColumnAndRow($col, $fil+4, "=SUM({$hoja->getCellByColumnAndRow($col,$this->fila_totales+2)->getCoordinate()}:{$hoja->getCellByColumnAndRow($this->col_final,$this->fila_totales+2)->getCoordinate()})");
        $hoja->getStyleByColumnAndRow($col, $fil+4)->getNumberFormat()->setFormatCode('$ #,##0.00');
        
        // IVA
        $hoja->mergeCellsByColumnAndRow(1,$fil+5,2,$fil+5);
        $hoja->setCellValueByColumnAndRow(1, $fil+5, "IVA 21%");
        // $hoja->setCellValueByColumnAndRow($col, $fil+5, "=({$hoja->getCellByColumnAndRow($col,$fil+4)->getCoordinate()} * {21%})");
        $hoja->setCellValueByColumnAndRow($col, $fil+5, "=({$hoja->getCellByColumnAndRow($col,$fil+4)->getCoordinate()} * 21 / 100)");
        $hoja->getStyleByColumnAndRow($col, $fil+5)->getNumberFormat()->setFormatCode('$ #,##0.00');

        // TOTAL A PAGAR
        $hoja->mergeCellsByColumnAndRow(1,$fil+6,2,$fil+6);
        $hoja->setCellValueByColumnAndRow(1, $fil+6, "TOTAL A PAGAR");
        $hoja->setCellValueByColumnAndRow($col, $fil+6, "=SUM({$hoja->getCellByColumnAndRow($col,$fil+4)->getCoordinate()}:{$hoja->getCellByColumnAndRow($col,$fil+5)->getCoordinate()})");
        $hoja->getStyleByColumnAndRow($col, $fil+6)->getNumberFormat()->setFormatCode('$ #,##0.00');

        $writer = new Xlsx($documento);
        $filename = 'rptOTs.xlsx';

        # Le pasamos la ruta de guardado
        $writer->save($filename);            }

        /* Here there will be some code where you create $spreadsheet */
        // // redirect output to client browser
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="myfile.xlsx"');
        // header('Cache-Control: max-age=0');

        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');
    
    public function indexx() {
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');
     
        
        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');
        // dd('hola mundo');
        $documento = new Spreadsheet();
        // $documento
        //     ->getProperties()
        //     ->setCreator("Aquí va el creador, como cadena")
        //     ->setLastModifiedBy('Parzibyte') // última vez modificado por
        //     ->setTitle('Mi primer documento creado con PhpSpreadSheet')
        //     ->setSubject('El asunto')
        //     ->setDescription('Este documento fue generado para parzibyte.me')
        //     ->setKeywords('etiquetas o palabras clave separadas por espacios')
        //     ->setCategory('La categoría');
         
        $hoja = $documento->getActiveSheet();
        $hoja->setTitle("El título de la hoja");
        $hoja->setCellValueByColumnAndRow(1, 1, "Un valor en 1, 1");
        $hoja->setCellValue("B3", "10");
        $hoja->setCellValue("B4", "20");
        $hoja->setCellValue("B5", "60");
        $hoja->setCellValue("B6", "=SUM(B3:B5)");

        $row=3;
        $col=2;

        $hoja->setCellValue('B8', "=COLUMN()");
        $hoja->setCellValueByColumnAndRow(2, 12, "=SUM(B{$row}:{$hoja->getCellByColumnAndRow($col, $row+8)->getCoordinate()})");
        // dd($hoja->getColumnDimension('D'));
         
        $writer = new Xlsx($documento);
         
        # Le pasamos la ruta de guardado
        $writer->save('ejemploExcel.xlsx');        
    }
}
