<?php

namespace App\Http\Livewire\Panel;

use App\Models\Ot;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PanelIndex extends Component
{
    // ESTADOS
    public $estado_entregado = 8;
    public $estado_entregado_pendientes = 7;
    public $estado_ingresado = 1;

    public $ots_mes;
    public $ots_entregadas;
    public $ots_procesadas;
    public $ots_pendientes;
    public $ots_clientes, $cliente_max;
    public $ots_antigua;
    public $ot_antigua_fecha, $ot_antigua_numero, $ot_antigua_cliente;

    public function mount() {
//         // OTs ingresadas en el mes
//         $mes = date('m');
//         $mes = 12;
// // dd($mes);
//         $this->ots_mes = Ot::whereMonth('fecha_alta', $mes)
//             ->count();
//             // dd($this->ots_mes);

//         // OTs entregadas
//         $this->ots_entregadas = Ot::whereMonth('fecha_alta', $mes)
//             ->where('estado_id', $this->estado_entregado)
//             ->count();
//             // dd($this->ots_entregadas);

//         // OTs Procesadas
//         $this->ots_procesadas = Ot::whereMonth('fecha_alta', $mes)
//             ->where('estado_id', '<>', $this->estado_entregado)
//             ->count();
//             // dd($this->ots_procesadas);

//         // OTs Pendientes
//         $this->ots_pendientes = Ot::whereMonth('fecha_alta', $mes)
//             ->where('estado_id', $this->estado_entregado_pendientes)
//             ->count();
            
//         // dd($this->ots_pendientes);
               
//         // Clientes con mas pedidos en el mes
//         $this->ots_clientes = Ot::query()
//                 ->when($mes, function($query, $mes) {
//                     $query->whereMonth('fecha_alta', $mes);
//                 })
//                 ->where('estado_id', 1)
//                 ->select(DB::raw('cliente_id, count(*) as max'))
//                 ->groupBy('cliente_id')
//                 ->orderBy('max', 'DESC')
//                 ->first();
        
//         if ($this->ots_clientes) {
//             $this->cliente_max = trim($this->ots_clientes->cliente->razonsocial . ' (' . $this->ots_clientes->max . ')');
//         } else {
//             $this->cliente_max = '---';
//         }

//         // OT mas antigua sin entregar
//         $this->ots_antigua = Ot::with('cliente')
//                 ->select('fecha_alta', 'numero','cliente_id')
//                 ->whereMonth('fecha_alta', $mes)
//                 ->where('estado_id', '<', $this->estado_entregado)
//                 ->orderBy('fecha_alta', 'ASC')
//                 ->first();

//         // Cuando no hay resultados se genera error en la asignacion x eso la pregunta.
//         if ($this->ots_antigua) {
//             $this->ot_antigua_fecha = $this->ots_antigua->fecha_alta;
//             $this->ot_antigua_numero = $this->ots_antigua->numero;
//             $this->ot_antigua_cliente = $this->ots_antigua->cliente->razonsocial;            
//         } else {
//             $this->ot_antigua_fecha = '-';
//             $this->ot_antigua_numero = '-';
//             $this->ot_antigua_cliente = '-';
//         }
    }
   
    public function render()
    {
        // return view('livewire.panel.panel-index')
        //         ->with(['ots_mes' => $this->ots_mes, 
        //                 'ots_entregadas' => $this->ots_entregadas,
        //                 'ots_procesadas' => $this->ots_procesadas,
        //                 'ots_pendientes' => $this->ots_pendientes,
        //                 'cliente_max' => $this->cliente_max,
        //                 'ot_antigua_fecha' => $this->ot_antigua_fecha,
        //                 'ot_antigua_numero' => $this->ot_antigua_numero,
        //                 'ot_antigua_cliente' => $this->ot_antigua_cliente
        //             ]);
        return view('livewire.panel.panel-index');

    }
}
