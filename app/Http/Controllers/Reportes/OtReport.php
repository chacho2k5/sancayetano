<?php

namespace App\Http\Controllers\Reportes;

use Throwable;
use App\Models\Estado;
use App\Models\Pedido;
use App\Models\EstadoPedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

// use Dompdf\Dompdf; 
// use Dompdf\Options;

class OtReport extends Controller
{

  // Estados
  public $estado_cargada = 1;
  public $estado_generada = 2;
  public $estado_en_proceso = 3;
  public $estado_terminada = 4;
  public $estado_facturado = 5;
  public $estado_despachada = 6;
  public $estado_entregada = 7;
  public $estado_anulada = 8;

  public $pedido_id;

    public function index($id = 0) {

      if($id == 0) {
        return back()->with('status', 'Debe seleccionar un Pedido.');
      }
      $this->pedido_id = $id;
      
      $registros = Pedido::all()->where('id',$id);
      $reporte = 'OT_' . $id . '.pdf';

      $pdf = Pdf::loadView('reportes.ot-report', compact('registros'));
      // return $pdf->stream($reporte);
      
      // return redirect()->away($pdf->stream($reporte));
      // return $pdf->stream("mypdf.pdf", [ "Attachment" => false]);

      // return redirect()->away($pdf->stream($reporte))->with('_blank');
      // return Redirect::to($pdf->stream($reporte));

      return $pdf->stream($reporte);
   
      // return $pdf->download('tutsmake.pdf');

      // // $pdf->loadHTML('<h1>PROBANDO PDF</h1>');

    }

    public function imprimirOt() {

      // GRABO LOS NUEVOS ESTADOS
  
      // Esto graba en un campo DateTime
      $fecha = now()->format('Y-m-d H:i:s');
      $msg = '';
  
      // Busco el nombre del estado generada
      $reg = Estado::Select('nombre')
          ->find($this->estado_generada);
          
      // $estado_nombre = $reg->nombre;
  
      DB::beginTransaction();
      try {
          // Grabo el nuevo cambio de estado.
          EstadoPedido::Create([
              'pedido_id' => $this->pedido_id,
              'estado_id' => $this->estado_generada,
              'fecha_inicio' => $fecha,
              'fecha_final' => $fecha,
              'observaciones' => 'OT generada'
          ]);
  
          // Actualizo el nuevo estado en la tabla Pedidos
          Pedido::where('id', $this->pedido_id)
                  ->update([
                      'estado_id' => $this->estado_generada,
                      'estado_nombre' => $reg->estado_nombre,
                      'estado_fecha' => $fecha,
                  ]);
  
          DB::commit();
  
          // $this->estado_id = $this->estado_generada;
          // $this->estado_nombre = $this->estado_nuevo_nombre;
  
          // $this->color_status = "success";
          // $msg = "La OT se ha generado correctamente";
  
          // return to_route('ots.report',[$this->pedido_id]);
  
      } catch (Throwable $e) {
  
          DB::rollBack();
  
          // dd('error ' . $e);
          // $this->color_status = "danger";
          // $msg = "Se ha producido un error. No se pudo generar la OT. Revise los datos y vuelvalo a intentar.";
      }
  
      // $this->dispatchBrowserEvent('close-modal');
      // return back()->with('status', $msg);
    }
}
