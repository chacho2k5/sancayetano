<?php

namespace App\Http\Livewire\OrdenTrabajo;

use Throwable;
use Carbon\Carbon;
use App\Models\Mes;
use App\Models\Estado;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\EstadoPedido;
use App\Models\OrdenTrabajo;
use Livewire\WithPagination;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class OrdenTrabajoIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $currentPage;
    protected $filas;


    // Busqueda y orden y paginacion tabla
    public $search = '';
    public $perPage = '20';
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
    public $estado_despachada = 5;
    public $estado_entregada = 6;
    public $estado_anulada = 7;

    // Variables SELECTs
    public $meses;
    public $selectedMes = null;

    public $query;
    protected $pedidos = [];
    public $pedido_id;        // ID de la OT seleccionada
    public $selectedRow = null;        // Indica si esta seleccionada una columna
    public $indexRow;

    public $reclamo;
    public $reclamo_detalle;
    public $reclamo_cerrado;

    // Tabla ESTADOS
    public $estados;        // Comobo estados p/filtro
    public $estado_id;      // ID del estado actual
    public $estado_orden, $estado_nombre, $estado_nuevo_nombre;
    public $selectedEstado, $selectedNewEstado;
    public $estado_observaciones;       // Observaciones al cambio de estado (tabla: estado_ots)

    protected $listeners = ['borrarReclamo'];

    protected function rules() {
        return [
            'reclamo_detalle' => 'string|max:3000',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $validationAttributes = [
        'reclamo_detalle' => 'Detalle Reclamo',
    ];

    protected $messages = [
        'reclamo_detalle' => [
            'required' => 'El Reclamo no puede quedar vacio.',
            'max' => 'Puede ingresar hasta 3000 caracteres.',
        ],
    ];
    
    public function mount($id = 0) 
    {

        $this->indexRow = 0;
        // $id = 290;

        // $pedido = OrdenTrabajo::find($id);
        
        // $a=OrdenTrabajo::find($id);
        // $indice = $a->search($id);
        // dd($a);

        // $position = $pedido->position;
        // dd($position);

        // $this->page = ceil($position / 20);

        // dd($this->page);

        // $this->gotoPage($this->page);

        // $id = 350;
        // $this->filas = OrdenTrabajo::paginate($this->perPage);
        // $this->currentPage = $this->getPageForPedido($id);

        $this->selectedRow = null;
        $this->reclamo = false;

        $this->meses = Mes::select('id','nombre')
                            ->orderBy('id', 'asc')
                            ->get();

        $this->estados = Estado::select('id','nombre')
                            ->orderBy('id', 'asc')
                            ->get();

        $this->selectedMes = (int) date('m');
    }

    // public function getPageForPedido($id)
    // {
    //     if ($id == 0) {
    //         return 1;
    //     }

    //     $index = $this->filas->search(function ($pedido) use ($id) {
    //         return $pedido->id == $id;
    //     });

    //     if ($index === false) {
    //         return 1;
    //     }

    //     return ceil(($index + 1) / $this->filas->perPage());
    // }

    public function render()
    {
        $this->indexRow = 0;

        $this->pedidos = OrdenTrabajo::query()
                ->where('anulada', false)
                ->when($this->selectedMes, function($query) {
                    $query->whereMonth('fecha_pedido', $this->selectedMes);
                })
                ->when($this->selectedEstado, function($query) {
                    $query->where('estado_id', $this->selectedEstado);
                })
                ->when($this->search, function($query) {
                    $query->where('razonsocial', 'like', '%' . $this->search . '%');
                })
                ->with('color:id,nombre', 'corte:id,nombre', 'tratado:id,nombre')
                ->select('*')
                ->orderBy($this->sortField, $this->sortOrden)
                ->paginate($this->perPage);

        return view('livewire.orden-trabajo.orden-trabajo-index',['registros' => $this->pedidos], ['indexRow' => $this->indexRow]);
    }

    public function updatingSearch()
    {

        // Se ejectua para "limpiar el filtro" antes de cambiar la condicion del mismo, en este caso la var. selectedMes
        $this->resetPage();
        $this->indexRow = 0;

    }

    public function updatingSelectedMes()
    {
        // $this->indexRow = 1000;

        // Se ejectua para "limpiar el filtro" antes de cambiar la condicion del mismo, en este caso la var. selectedMes
        $this->resetPage();
        $this->indexRow = 0;

    }

    public function updatingSelectedEstado()
    {
        // Se ejectua para "limpiar el filtro" antes de cambiar la condicion del mismo, en este caso la var. selectedMes
        $this->resetPage();
        $this->indexRow = 0;

    }

    public function updatedselectedMes($value) {
        $this->indexRow = 0;

        $this->resetPage();
        $this->indexRow = 0;

        // $this->selectedMes;
        // if($value ==! null) {
        // } else {
        // }
    }

    public function updatedselectedEstado($value) {
        // dd($value);
        // $this->resetPage();
        // $this->selectedMes;
        // if($value ==! null) {
        // } else {

        // }
    }

    public function editarOt($action) 
    {
        $this->modal_action = $action;

        // $pedidos = OrdenTrabajo::orderBy('id')->get();
        // $pedido = $pedidos->firstWhere('id', $this->pedido_id);
        // $posicion = $pedidos->search($pedido) + 1;

        // $posicion = OrdenTrabajo::where('id', '=', $this->pedido_id)
        //     ->pluck('id')
        //     ->count();

        // dd($posicion . ' - row: ' . $this->selectedRow);

        // dd($this->pedido_id . ' - row: ' . $this->selectedRow);

        if($action == 'create') {
            $id = 0;
            return to_route('ots.create',[$action,$id]);
        }

        if ($this->validarEdicion($action))
        {
            if($action == 'delete') {
                $this->modal_title = "BORRAR Pedido";
                $this->modal_content = 'Desea borrar el Pedido seleccionado ?';
                $this->dispatchBrowserEvent('show-delete-modal');
                return;
            }

            if($action == 'reclamo') {
                $this->reclamoModal();
                return;
            }

            if($action == 'estado') {
                $this->cambiarEstadoModal();
                return;
            }

            if($action == 'imprimir') {
                $this->modal_title = "Imprimir Orden de Trabajo";
                $this->modal_content = 'Desea imprimir la OT seleccionada ?';
                $this->dispatchBrowserEvent('show-imprimir-modal');
                return;
            }

            $id = $this->pedido_id;
            return to_route('ots.create', [$action,$id]);
        }

    }

    public function imprimirOt() {
        
        dd('imprimiendo ot...');
        $this->dispatchBrowserEvent('show-imprimir-modal');

    }

    public function cambiarEstadoModal() {
        
        $this->reset('estado_observaciones','selectedNewEstado', 'estado_nuevo_nombre');

        $this->modal_title = "CAMBIAR ESTADO";
        $this->modal_width = 'md';
        
        // Estado actual
        $estado = $this->estados->find($this->estado_id);

        $this->estado_nombre = $estado->nombre;

        // Proximo estado
        $orden = $estado->orden + 1;
        $estado = $this->estados->firstWhere('orden', $orden);

        $this->selectedNewEstado = $estado->id;
        $this->estado_nuevo_nombre = $estado->nombre;

        $this->dispatchBrowserEvent('show-estado-modal');
    }

    public function grabarNuevoEstado() {

        // $fecha = now();
        // $fecha = Carbon::now()->format('Y-m-d\TH:i:s');
        
        // $fecha = Carbon::now();
        // $fecha->toDateTimeString();

        // $fecha = Carbon::now()->format('Y-m-d\TH:i');
        
        // dd($fecha);
        // $date = Carbon::now();
        // $date->toDateString();                          // 1975-12-25
        // $date->toFormattedDateString();                 // Dec 25, 1975
        // $date->toTimeString();                          // 14:15:16
        // $date->toDateTimeString();                      // 1975-12-25 14:15:16

        // Esto graba en un campo DateTime
        $fecha = now()->format('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            EstadoPedido::Create([
                'pedido_id' => $this->pedido_id,
                'estado_id' => $this->selectedNewEstado,
                'fecha_inicio' => $fecha,
                'fecha_final' => $fecha,
                'observaciones' => substr($this->estado_observaciones,0,500)
            ]);

            OrdenTrabajo::where('id', $this->pedido_id)
                    ->update([
                        'estado_id' => $this->selectedNewEstado,
                        'estado_nombre' => $this->estado_nuevo_nombre,
                        'estado_fecha' => $fecha,
                    ]);

            DB::commit();

        } catch (Throwable $e) {

            DB::rollBack();

            // Mostrar mensaje de error
        }

        $this->estado_id = $this->selectedNewEstado;
        $this->estado_nombre = $this->estado_nuevo_nombre;

        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function reclamoModal() {
        
        $this->modal_title = "NUEVO RECLAMO";
        $this->modal_width = 'md';

        $reg = OrdenTrabajo::select('reclamo','reclamo_detalle')
            ->where('id', $this->pedido_id)
            ->first();

        if($reg) {
            $this->reclamo = $reg->reclamo;
            $this->reclamo_detalle = $reg->reclamo_detalle;
        }

        $this->dispatchBrowserEvent('show-reclamo-modal');

        // dd($this->pedido_id);
    }

    public function editarReclamo($action) {
        if($this->pedido_id !== null)      // Es un ALTA
        {
            if ($action == 'borrar') {
                $this->dispatchBrowserEvent('borrar-reclamo', [
                    'msg' => '¿Desea borrar el reclamo?'
                ]);
            } else {
                $this->validate();

                $this->reclamo = true;

                $this->updateReclamo();
            }

        }
    }

    public function borrarReclamo() {
        $this->reclamo = false;
        $this->reclamo_detalle = '';

        $this->updateReclamo();
    }

    public function updateReclamo() {
        OrdenTrabajo::where('id', $this->pedido_id)
                ->update(
                    ['reclamo' => $this->reclamo,
                    'reclamo_detalle' => trim($this->reclamo_detalle),
            ]);

        $this->reset('reclamo','reclamo_detalle');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete() {

        OrdenTrabajo::where('id', $this->pedido_id)
                ->update(['anulada' => true]);

        $this->dispatchBrowserEvent('close-modal');
        // // session()->flash('message', 'Registro borrado exitosamente '.$this->pedido_id);
        $this->reset('pedido_id', 'selectedRow', 'estado_id');
    }

    public function validarEdicion($value) {

        $msg = null;
        $result = true;

        if(($value=='edit' || $value=='show' || $value=='delete' || $value=='reclamo' || $value=='estado') && $this->selectedRow == null) {
            $msg = 'Debe seleccionar un Pedido.';
        }

        if(($value=='edit' || $value=='delete' || $value=='reclamo' || $value=='estado') && $this->selectedRow && $this->estado_id == $this->estado_terminada) {
            $msg = 'El Pedido esta Terminado. No se puede editar y/o borrar.';
        }

        if($msg) {
            $result = false;
            $this->modal_width = 'sm';
            $this->modal_title = "Orden de Trabajo";
            $this->modal_content = $msg;
            $this->dispatchBrowserEvent('show-alert-modal');
        }

        return $result;
    }

    public function cancelModal() {

        $this->dispatchBrowserEvent('close-modal');
        // $this->reset('reclamo','reclamo_detalle');
    }

    public function asignarId($id) {
        $reg = OrdenTrabajo::find($id);

        $this->estado_id = $reg->estado_id;
        $this->estado_nombre = $reg->estado_nombre;
        $this->reclamo = $reg->reclamo;
        $this->reclamo_detalle = $reg->reclamo_detalle;
    }

    public function order($sort) {

        if($this->sortField == $sort) {
            if($this->sortOrden == 'asc') {
                $this->sortOrden = 'desc';
            } else {
                $this->sortOrden = 'asc';
            }
        } else {
            $this->sortField = $sort;
            $this->sortOrden = 'asc';
        }
    }
}
