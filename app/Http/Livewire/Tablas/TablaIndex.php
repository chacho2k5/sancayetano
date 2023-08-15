<?php

namespace App\Http\Livewire\Tablas;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class TablaIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $currentPage;
    protected $filas;
    
    public $color_status = 'danger';        // Color para el alerta de mensajes via status

    // Busqueda y orden y paginacion tabla
    public $search = '';
    public $perPage = '2';
    public $sortField = 'fecha_pedido';
    public $sortOrden = 'desc';

    // Modales
    public $modal_title;
    public $modal_action;
    public $modal_content;
    public $modal_width = 'md';

    // Estados
    public $estado_cargada = 1;
    public $estado_generada = 2;
    public $estado_en_proceso = 3;
    public $estado_terminada = 4;
    public $estado_facturado = 5;
    public $estado_despachada = 6;
    public $estado_entregada = 7;
    public $estado_anulada = 8;

    // Variables SELECTs
    public $meses;
    public $selectedMes = null;

    public $query;
    protected $pedidos = [];
    public $pedido_id;        // ID de la OT seleccionada
    public $selectedRow = null;        // Indica si esta seleccionada una columna
    // public $indexRow;

    public $reclamo;
    public $reclamo_detalle;
    public $reclamo_cerrado;

    // Tabla ESTADOS
    public $estados;        // Comobo estados p/filtro
    public $estado_id;      // ID del estado actual
    public $estado_orden, $estado_nombre, $estado_nuevo_nombre;
    public $selectedEstado, $selectedNewEstado;
    public $estado_observaciones;       // Observaciones al cambio de estado (tabla: estado_ots)
    
    public function render()
    {
        $this->pedidos = Pedido::query()
                ->where('anulada', false)
                ->with('color:id,nombre', 'corte:id,nombre', 'tratado:id,nombre')
                ->select('*')
                ->orderBy($this->sortField, $this->sortOrden)
                ->paginate($this->perPage);
                // ->simplePaginate($this->perPage);
                // ->cursorPaginate($this->perPage);

        return view('livewire.tablas.tabla-index',['registros' => $this->pedidos]);
    }
}
