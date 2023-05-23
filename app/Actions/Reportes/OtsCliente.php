<?php 
namespace App\Actions\Reportes;

use App\Models\Articulo;
use Livewire\Component; 
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OtsCliente extends Component
{

    // chacho - Creo q ninguna de estas variables deberian ser publicas
    public $header;
    public $rows;
    public $articulos;

    public $col_articulos = 2;      // Columna donde inician los articulos
    public $col_final;              // Ultima columna de articulos
    public $fil_detalle = 5;
    public $fila_detalle_final;
    public $fila_totales;       // Fila de inicio de los totales

    public $fecha_desde;
    public $fecha_hasta;
    public $cliente_id, $razonsocial;
    public $ot_id, $fecha_alta, $numero;

    public function execute($cliente, $desde, $hasta) 
    {
        $this->cliente_id = $cliente;
        $this->fecha_desde = $desde;
        $this->fecha_hasta = $hasta;
      
        // dd($this->fecha_hasta);

        if ($cliente == 0) {
            return "Debe ingregar un cliente.";
        }

        $this->header = DB::table('ots')
                ->when($this->fecha_desde, function($query) {
                    $query->whereBetween('ots.fecha_alta', [$this->fecha_desde, $this->fecha_hasta]);
                })
                ->where('ots.cliente_id', $this->cliente_id)
                ->join('clientes','ots.cliente_id', '=', 'clientes.id')
                ->select('ots.id','ots.fecha_alta','numero', 'razonsocial')
                ->orderBy('fecha_alta', 'desc')
                ->get();

                // dd($this->header);

                // $headerOt = Ot::query()
                // ->when($this->filter_fecha_desde, function($query) {
                //     $query->whereBetween('fecha_alta', [$this->filter_fecha_desde, $this->filter_fecha_hasta]);
                // })
                // ->when($this->filter_numero_ot, function($query) {
                //     $query->where('numero', 'like', $this->filter_numero_ot .'%');
                // })
                // ->when($this->selectedEstado, function($query) {
                //     $query->where('estado_id', 'like', $this->selectedEstado);
                // })
                // ->when($this->filter_cliente, function($query) {
                //     $query->where('cliente_id', 'like', $this->filter_cliente);
                // })
                // ->with('cliente:id,razonsocial,calle_nombre,calle_numero','estado:id,descripcion,orden')
                // ->select('id','fecha_alta','numero','pendiente_numero','tiempo_planchado','cliente_id','estado_id')
                // ->orderBy('fecha_alta','desc')
                // ->paginate(20);
                
                
        if (count($this->header) == 0) {
            return 'No hay datos para el filtro seleccionado.';
        }

        // Id del la 1er OT
        $this->razonsocial = $this->header->value('razonsocial');

        // dd($this->razonsocial);

        // Para armar los encabezados de las columnas de articulos
        $this->articulos = Articulo::select('descripcion','orden')
                ->orderBy('orden', 'asc')
                ->get();
                // ->toArray();

        $this->col_final = count($this->articulos) + $this->col_articulos;

        $documento = new Spreadsheet();
        $hoja = $documento->getActiveSheet();

        // TITULO HOJA
        $hoja->setTitle(substr($this->razonsocial,0,30));

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

        for($col = $this->col_articulos + 1; $col <= $this->col_final; $col++) {            
            $hoja->setCellValueByColumnAndRow($col, $this->fila_totales, "=SUM({$hoja->getCellByColumnAndRow($col,$this->fil_detalle)->getCoordinate()}:{$hoja->getCellByColumnAndRow($col,$this->fila_detalle_final)->getCoordinate()})");
            if($hoja->getCellByColumnAndRow($col, $this->fila_totales)->getCalculatedValue() == 0) {
                $hoja->getColumnDimensionByColumn($col)->setVisible(false);
            }
        }

        $hoja->mergeCellsByColumnAndRow(1,$fil+1,2,$fil+1);
        $hoja->setCellValueByColumnAndRow(1, $fil+1, "Precio x Unidad");
        // Aplico el formato $#.## a un rango de celdas (toda la fila)
        $col = $this->col_articulos + 1;
        $hoja->getStyleByColumnAndRow($col, $fil+1,$this->col_final,$fil+1)->getNumberFormat()->setFormatCode('$ #,##0.00');


        $hoja->mergeCellsByColumnAndRow(1,$fil+2,2,$fil+2);
        $hoja->setCellValueByColumnAndRow(1, $fil+2, "TOTAL");
        // TOTAL = CANT. UNIDADES * PRECIO x UNIDAD
        for($col = $this->col_articulos + 1; $col <= $this->col_final; $col++) {            
            $hoja->setCellValueByColumnAndRow($col, $this->fila_totales+2, "=({$hoja->getCellByColumnAndRow($col,$this->fila_totales)->getCoordinate()} * {$hoja->getCellByColumnAndRow($col,$this->fila_totales+1)->getCoordinate()})");
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
        $filename = 'OrdenTrabajo_Clientes.xlsx';
        $writer->save($filename);
        redirect(url('/' . $filename));
        return 'ok';
        
        // return Storage::download('file.jpg', $name, $headers);
        // return Storage::download(url('/' . $filename));

        // $writer->save('/reportes/' . $filename);
        // return redirect(url('/reportes/' . $filename));
        // dd(dirname(__FILE__));

        // $ruta = "/opt/lampp/htdocs/proyectos/lavanderiao3/app/Actions/Reportes";
        
        // $ruta = 'reportes\\file.xlsx';
        // dd(url('/'));
        // dd(Storage::disk('public'));
        // dd(storage_path());
        
        // $writer->save(storage_path() . '/' . $filename);

        // $aux = env('APP_URL').'/storage';
        // redirect(url('/' . $filename));
        // redirect(storage_path() . '/' . $filename);

        // dd(Storage::path($filename));

        // $file = Storage::path($filename);

        // dd(storage_path());
        // dd(env('APP_URL').'/storage');

        // Storage::delete($file);

        // if (unlink($filename)) {
        //     dd('archivo borrado');
        // }


        /* Here there will be some code where you create $spreadsheet */
        // // redirect output to client browser

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="rptOTs.xlsx"');
        // header('Cache-Control: max-age=1');
        
        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($documento, 'Xlsx');
        // $writer->save('php://output');    
        
        // return redirect(url('/' . $filename));


    }
}