<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\Bolsa;
use App\Models\Color;
use App\Models\Corte;
use Throwable;
use Carbon\Carbon;
use App\Models\Mes;
use App\Models\Estado;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\EstadoPedido;
use App\Models\Material;
use App\Models\Pedido;
use App\Models\Setup;
use App\Models\Trabajo;
use App\Models\Tratado;
use Faker\Core\Number;
use Livewire\WithPagination;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class TrabajoIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $currentPage;
    protected $filas;
    
    public $color_status = 'danger';        // Color para el alerta de mensajes via status

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
    public $estado_facturado = 5;
    public $estado_despachado = 6;
    public $estado_entregado = 7;
    public $estado_anulada = 8;

    // Variables SELECTs
    public $meses;
    public $selectedMes = null;

    public $query;
    protected $trabajos = [];
    public $trabajo_id;        // ID de la OT seleccionada
    public $pedido_id;         // Los estados se registran con el ID del pedido.
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

    // Variables edicion trabajo
    public $numero_ot;
    public $fecha_pedido;
    public $fecha_entrega;
    public $cliente_nombre;
    public $trabajo_nombre;
    public $cantidad_bolsas;
    public $cantidad_bolsas_trabajo;

    public $observaciones;
    public $bultos;

    public $precio_unitario;
    public $precio_subtotal;
    // public $precio_iva;
    public $importe_iva;
    public $precio_total;

    public $setup;    // iva y demas
    public $selectedIVA;
    public $iva;
    public $iva1, $iva2;

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

        // $this->indexRow = 0;

        $this->selectedRow = null;
        $this->reclamo = false;

        // IVA
        $this->setup = Setup::select('iva1', 'iva2')->first();
        $this->iva1 = $this->setup->iva1;
        $this->iva2 = $this->setup->iva2;
        $this->selectedIVA = 0;

        // dd($this->selectedIVA);

        $this->meses = Mes::select('id','nombre')
                            ->orderBy('id', 'asc')
                            ->get();

        $this->estados = Estado::select('id','nombre')
                            ->orderBy('id', 'asc')
                            ->get();

        $this->selectedMes = (int) date('m');
    }

    public function render()
    {
        $this->trabajos = Trabajo::query()
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

        return view('livewire.trabajos.trabajo-index',['registros' => $this->trabajos]);
    }

    public function updatingSearch()
    {
        // Se ejectua para "limpiar el filtro" antes de cambiar la condicion del mismo, en este caso la var. selectedMes
        $this->resetPage();
        // $this->indexRow = 0;

    }

    public function updatingSelectedMes()
    {
        // $this->indexRow = 1000;

        // Se ejectua para "limpiar el filtro" antes de cambiar la condicion del mismo, en este caso la var. selectedMes
        $this->resetPage();
        // $this->indexRow = 0;

    }

    public function updatingSelectedEstado()
    {
        // Se ejectua para "limpiar el filtro" antes de cambiar la condicion del mismo, en este caso la var. selectedMes
        $this->resetPage();
        // $this->indexRow = 0;

    }

    public function updatedselectedMes($value) {
        // $this->indexRow = 0;

        $this->resetPage();
        // $this->indexRow = 0;

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

    public function calcularTotales() {
        $this->precio_subtotal = $this->precio_unitario * $this->cantidad_bolsas_trabajo;
        $this->importe_iva = $this->precio_subtotal * ($this->selectedIVA / 100);
        $this->precio_total = $this->precio_subtotal + $this->importe_iva;
    }
    
    public function updatedCantidadBolsasTrabajo($value) {
        $this->calcularTotales();
    }

    public function updatedSelectedIVA($value) {
        // dd($value);
        $this->calcularTotales();
    }

    public function updatedPrecioUnitario($value) {
        $this->calcularTotales();
    }

    public function validarEdicion($value) {

        $msg = null;
        $result = true;

        if(($value=='update' || $value=='show' || $value=='reclamo' || $value=='estado') && $this->selectedRow == null) {
            $msg = 'Debe seleccionar un Trabajo.';
        }

        if(($value=='update' || $value=='reclamo') && $this->selectedRow && $this->estado_id >= $this->estado_facturado) {
            $msg = 'El Trabajo ya se facturo. No se puede editar y/o borrar.';
        }

        if(($value=='update' || $value=='reclamo') && $this->selectedRow && $this->estado_id > $this->estado_facturado) {
            $msg = 'El Trabajo ya se facturo y despacho. No se puede editar y/o borrar.';
        }

        if(($value=='estado') && $this->selectedRow && $this->estado_id >= $this->estado_entregado) {
            $msg = 'El Trabajo ya se facturo y despacho y ebntrego. No se puede editar y/o borrar.';
        }


        if($msg) {
            $result = false;
            $this->modal_width = 'sm';
            $this->modal_title = "TRABAJOS";
            $this->modal_content = $msg;
            $this->dispatchBrowserEvent('show-alert-modal');
        }

        return $result;
    }

    public function updateTrabajo($action) 
    {
        $this->modal_action = $action;

        if ($this->validarEdicion($action))
        {
            if($action == 'update') {
                $this->trabajoModal();
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

            // return to_route('trabajos.update', [$action,$this->trabajo_id]);
        }

    }

    public function trabajoModal() {
        
        $this->resetModalTrabajo();

        $this->modal_title = "ACTUALIZAR TRABAJO";
        $this->modal_width = 'lg';

        $reg = Trabajo::select('*')
            ->where('id', $this->trabajo_id)
            ->first();

            
        if($reg) {
            $this->numero_ot = $reg->numero_ot;
            // $this->fecha_pedido = date('Y-m-d', strtotime($reg->fecha_pedido));
            // $this->fecha_entrega = date('Y-m-d', strtotime($reg->fecha_entrega));
            // $this->cliente_nombre = $reg->razonsocial;
            $this->trabajo_nombre = $reg->trabajo_nombre;
            $this->cantidad_bolsas = $reg->cantidad_bolsas;
            $this->cantidad_bolsas_trabajo = $reg->cantidad_bolsas;     //Cargo las bolsas "teoricas" q se cargaron en el Pedido, dpes hay q ver si las dejan igual en el TRABAJO
            $this->precio_unitario = $reg->precio_unitario;
            $this->selectedIVA = $reg->iva;        // Se obtiene del valor cargado en la tabla SETUP
            $this->precio_subtotal = $reg->precio_subtotal;
            $this->importe_iva = $reg->importe_iva;
            $this->precio_total = $reg->precio_total; 
            $this->bultos = $reg->bultos;
            $this->observaciones = $reg->observaciones;
            // dd($this->selectedIVA . ' - ' . $reg->iva);
        }

        $this->dispatchBrowserEvent('show-trabajo-modal');
    }

    public function grabarTrabajo() {

        // Esto graba en un campo DateTime
        // $fecha = now()->format('Y-m-d H:i:s');
        // $pedido = Trabajo::find($this->trabajo_id);
        $msg = '';

        DB::beginTransaction();
        try {
            Trabajo::where('id', $this->trabajo_id)
                    ->update([
                        'cantidad_bolsas_trabajo' => $this->cantidad_bolsas_trabajo,
                        'bultos' => $this->bultos,
                        'precio_unitario' => $this->precio_unitario,
                        'iva' => $this->selectedIVA,
                        'precio_subtotal' => $this->precio_subtotal,
                        'importe_iva' => $this->importe_iva,
                        'precio_total' => $this->precio_total,
                        'observaciones' => $this->observaciones,
                    ]);

            DB::commit();

            // $this->estado_id = $this->selectedNewEstado;
            // $this->estado_nombre = $this->estado_nuevo_nombre;

            $this->color_status = "success";
            $msg = "Los datos se grabaron correctamente";

            $this->resetModalTrabajo();

        } catch (Throwable $e) {

            DB::rollBack();

            // Mostrar mensaje de error
            dd('error ' . $e);
            $this->color_status = "danger";
            $msg = "Se ha producido un error. Revise los datos y vuelvalo a intentar.";
        }

        $this->dispatchBrowserEvent('close-modal');
    }

    public function cambiarEstadoModal() {
        
        $this->modal_title = "CAMBIAR ESTADO";
        $this->modal_width = 'md';

        // Controlo si antes de facturar ya se cargaron los precios y demas
        if($this->estado_id == $this->estado_terminada) {
            $reg = Trabajo::select('*')
                ->where('id', $this->trabajo_id)
                ->first();
            $aux = $reg->precio_unitario * $reg->precio_subtotal;
            if($aux == 0) {
                $this->modal_width = 'sm';
                $this->modal_title = "TRABAJOS";
                $this->modal_content = 'Antes de facturar se deberian ingresar los importes...';
                $this->dispatchBrowserEvent('show-alert-modal');
                return;
            }
        }

        $this->reset('estado_observaciones','selectedNewEstado', 'estado_nuevo_nombre');
        
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

        // Esto graba en un campo DateTime
        $fecha = now()->format('Y-m-d H:i:s');

        $pedido = Trabajo::find($this->trabajo_id);

        DB::beginTransaction();
        try {
            EstadoPedido::Create([
                'pedido_id' => $pedido->pedido_id,
                'estado_id' => $this->selectedNewEstado,
                'fecha_inicio' => $fecha,
                'fecha_final' => $fecha,
                'observaciones' => substr($this->estado_observaciones,0,1000)
            ]);

            Trabajo::where('id', $this->trabajo_id)
                    ->update([
                        'estado_id' => $this->selectedNewEstado,
                        'estado_nombre' => $this->estado_nuevo_nombre,
                        'estado_fecha' => $fecha,
                    ]);

            DB::commit();

            $this->estado_id = $this->selectedNewEstado;
            $this->estado_nombre = $this->estado_nuevo_nombre;

            $this->color_status = "success";
            $msg = "El estado se ha cambiado correctamente";

        } catch (Throwable $e) {

            DB::rollBack();

            // Mostrar mensaje de error
            // dd('error ' . $e);
            $this->color_status = "danger";
            $msg = "Se ha producido un error. No se pudo cambiar de estado. Revise los datos y vuelvalo a intentar.";
        }

        $this->dispatchBrowserEvent('close-modal');
    }
    
    public function reclamoModal() {
        
        $this->modal_title = "NUEVO RECLAMO";
        $this->modal_width = 'md';

        $reg = Pedido::select('reclamo','reclamo_detalle')
            ->where('id', $this->trabajo_id)
            ->first();

        if($reg) {
            $this->reclamo = $reg->reclamo;
            $this->reclamo_detalle = $reg->reclamo_detalle;
        }

        $this->dispatchBrowserEvent('show-reclamo-modal');

        // dd($this->trabajo_id);
    }

    public function editarReclamo($action) {
        if($this->trabajo_id !== null)      // Es un ALTA
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
        Pedido::where('id', $this->trabajo_id)
                ->update(
                    ['reclamo' => $this->reclamo,
                    'reclamo_detalle' => trim($this->reclamo_detalle),
            ]);

        $this->reset('reclamo','reclamo_detalle');
        $this->dispatchBrowserEvent('close-modal');
    }

    // public function delete() {

    //     Pedido::where('id', $this->trabajo_id)
    //             ->update(['anulada' => true]);

    //     $this->dispatchBrowserEvent('close-modal');
    //     // // session()->flash('message', 'Registro borrado exitosamente '.$this->trabajo_id);
    //     $this->reset('trabajo_id', 'selectedRow', 'estado_id');
    // }

    public function resetModalTrabajo() {
        $this->reset('cantidad_bolsas_trabajo', 'bultos', 'selectedIVA', 'precio_unitario', 'precio_subtotal', 'importe_iva', 'precio_total', 'observaciones');
    }
    
    public function cancelModal() {

        $this->dispatchBrowserEvent('close-modal');
        // $this->reset('reclamo','reclamo_detalle');
    }

    // public function asignarId($id) {
    //     $reg = Pedido::find($id);

    //     $this->estado_id = $reg->estado_id;
    //     $this->estado_nombre = $reg->estado_nombre;
    //     $this->reclamo = $reg->reclamo;
    //     $this->reclamo_detalle = $reg->reclamo_detalle;
    // }

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

