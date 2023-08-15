<?php

namespace App\Http\Livewire\Pedidos;

use Throwable;
use Carbon\Carbon;
use App\Models\Mes;
use App\Models\Bolsa;
use App\Models\Color;
use App\Models\Corte;
use App\Models\Estado;
use App\Models\Pedido;
use App\Models\Reclamo;
use App\Models\Trabajo;
use App\Models\Tratado;
use Livewire\Component;
use App\Models\Material;
use Illuminate\View\View;
use App\Models\EstadoPedido;
use Livewire\WithPagination;
use Ramsey\Uuid\Type\Integer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Int_;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class PedidoIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $currentPage;
    protected $filas;
    
    public $color_status = 'danger';        // Color para el alerta de mensajes via status

    // Busqueda y orden y paginacion tabla
    public $search = '';
    public $perPage = '13';
    public $selectedPerPage = '13';
    public $sortField = 'numero_ot';
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
    public $estado_entregada = 6;
    public $estado_anulada = 7;

    // RECLAMOS
    // public $reclamos;
    // public $reclamoFechaInicio, $reclamoFechaFin;
    // public $reclamoClienteId;       // ID del cliente para el reclamo seleccionado
    // public $reclamoPedidoId;       // ID del Pedidocliente para el reclamo seleccionado
    // public $reclamoObservaciones;
    // public $reclamoEstado;  // true->cerrado - false->abierto
    // public $reclamosClienteId;
    // public $reclamosCliente;

    // public $pedidoReclamo;          // Si el pedido tiene o tuvo un reclamo
    // public $pedidoReclamoCerrado;   // Si el pedido esta abierto o cerrado

    // Variables SELECTs
    public $meses;
    public $selectedMes = null;

    public $query;
    protected $pedidos = [];
    public $pedido_id;        // ID de la OT seleccionada
    public $selectedRow = null;        // Indica si esta seleccionada una columna
    // public $indexRow;

    // public $reclamo_cerrado;
    // RECLAMOS
    public $reclamo;
    public $reclamo_inicio, $reclamo_final;
    public $reclamo_detalle;

    // Tabla ESTADOS
    public $estados;        // Comobo estados p/filtro
    public $estado_id;      // ID del estado actual
    public $estado_orden, $estado_nombre, $newEstadoNombre;
    public $selectedEstado, $selectedNewEstado;
    public $newEstadoObservaciones;       // Observaciones al cambio de estado (tabla: estado_ots)

    protected $listeners = ['borrarReclamo'];

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    // protected function rules() {
    //     return [
    //         'reclamo_detalle' => 'string|max:2000',
    //     ];
    // }

    // protected $validationAttributes = [
    //     'reclamo_detalle' => 'Detalle Reclamo',
    // ];

    // protected $messages = [
    //     'reclamo_detalle' => [
    //         'required' => 'El Reclamo no puede quedar vacio.',
    //         'max' => 'Puede ingresar hasta 2000 caracteres.',
    //     ],
    // ];
    
    public function mount($id = 0) 
    {

        // $this->indexRow = 0;

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
        // $this->indexRow = 0;

        $this->pedidos = Pedido::query()
                ->where('anulada', false)
                ->when($this->selectedMes, function($query) {
                    $query->whereMonth('fecha_pedido', $this->selectedMes);
                })
                ->when($this->selectedEstado, function($query) {
                    $query->where('estado_id', $this->selectedEstado);
                })
                ->when($this->search, function($query) {
                    $query->where('razonsocial', 'like', '%' . $this->search . '%')
                          ->orWhere('trabajo_nombre', 'like', '%' . $this->search . '%');;
                })
                ->with('color:id,nombre', 'corte:id,nombre', 'tratado:id,nombre')
                ->select('*')
                ->orderBy($this->sortField, $this->sortOrden)
                ->paginate($this->selectedPerPage);
                // ->simplePaginate($this->perPage);
                // ->cursorPaginate($this->perPage);

        // return view('livewire.pedidos.pedido-index',['registros' => $this->pedidos], ['indexRow' => $this->indexRow]);
        return view('livewire.pedidos.pedido-index',['registros' => $this->pedidos]);
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

    public function updatedselectedNewEstado($value) {
        // $db = $this->estados->find($value);
        $this->newEstadoNombre = Estado::getNombreEstado($value);
        // dd($db->nombre);
        // $this->resetPage();
        // $this->selectedMes;
        // if($value ==! null) {
        // } else {

        // }
    }

    //
    // Al presionar un boton 1ero se valida si se puede ejecutar la accion, si hay una fila seleccionada, etc.
    //
    public function validarEdicion($value) 
    {
        $msg = null;
        $result = true;

        if(($value=='edit' || $value=='show' || $value=='delete' || $value=='reclamo' || $value=='estado' || $value=='imprimir-ot') && $this->selectedRow == null) {
            $msg = 'Debe seleccionar un Pedido.';
        }

        // if(($value=='edit' || $value=='delete' || $value=='reclamo' || $value=='estado' || $value=='imprimir-ot') && $this->selectedRow && $this->estado_id == $this->estado_terminada) {
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


    public function editarOt($action) 
    {
        $this->modal_action = $action;

        // return to_route('ots.report',[$this->pedido_id]);

        if($action == 'create') {
            $id = 0;
            return to_route('pedidos.update',[$action,$id]);
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

            if($action == 'imprimir-ot' || $action == 'imprimir-ot-row') {
                $this->modal_title = "Imprimir Orden de Trabajo";

                // if($this->estado_id > $this->estado_cargada) {
                //     $this->modal_content = 'No se puede volver a generar la OT seleccionada.';
                //     $this->dispatchBrowserEvent('show-alert-modal');
                // } else {
                //     $this->modal_content = 'Desea imprimir la OT seleccionada ?';
                //     $this->dispatchBrowserEvent('show-imprimir-modal');
                // }

                $this->modal_content = 'Desea imprimir la OT seleccionada ?';
                $this->dispatchBrowserEvent('show-imprimir-modal');

                return;
            }

            $id = $this->pedido_id;
            return to_route('pedidos.update', [$action,$id]);
        }

    }

    public function imprimirOt() {

        // GRABO LOS NUEVOS ESTADOS

        // Esto graba en un campo DateTime
        $fecha = now()->format('Y-m-d H:i:s');
        $msg = '';

        // Busco el nombre del estado generada
        $estado = $this->estados->find($this->estado_generada);
        $this->estado_nombre = $estado->nombre;

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
                        'estado_nombre' => $this->estado_nombre,
                        'estado_fecha' => $fecha,
                    ]);
 

            DB::commit();

            $this->estado_id = $this->estado_generada;
            $this->estado_nombre = $this->newEstadoNombre;

            $this->color_status = "success";
            $msg = "La OT se ha generado correctamente";

            return to_route('ots.report',[$this->pedido_id]);

            // $ot = Pedido::find($this->pedido_id);
            // $reporte = 'OT_' . $ot->numero_ot . '.pdf';
            // $logo = "img/logo_ot_3.png";
            // $pdf = Pdf::loadView('reportes.ot-report', compact('ot'));
            // return $pdf->stream('reporte.pdf');

            // $pdf = Pdf::loadView('reportes.ot-report',['ot' => $ot]);
            // return $pdf->stream($reporte);
            // return $pdf->download($reporte);

            // $pdf->loadHTML('<h1>PROBANDO PDF</h1>');

            // $pdf = Pdf::loadView('reportes.ot-report',['ot' => $ot, 'logo' => $logo]);

            

        } catch (Throwable $e) {

            DB::rollBack();

            // dd('error ' . $e);
            $this->color_status = "danger";
            $msg = "Se ha producido un error. No se pudo generar la OT. Revise los datos y vuelvalo a intentar.";
        }

        $this->dispatchBrowserEvent('close-modal');

        return back()->with('status', $msg);
    }

    public function cambiarEstadoModal() {
        
        $this->reset('newEstadoObservaciones','selectedNewEstado', 'newEstadoNombre');

        $this->modal_title = "CAMBIAR ESTADO";
        $this->modal_width = 'md';
        
        // Estado actual
        $estado = $this->estados->find($this->estado_id);
        $this->estado_nombre = $estado->nombre;

        // Proximo estado
        $orden = $estado->orden + 1;
        $estado = $this->estados->firstWhere('orden', $orden);

        $this->selectedNewEstado = $estado->id;
        $this->newEstadoNombre = $estado->nombre;

        $this->dispatchBrowserEvent('show-estado-modal');
    }

    public function grabarNuevoEstado() {

        // Esto graba en un campo DateTime
        $fecha = now()->format('Y-m-d H:i:s');
        $msg = '';

        DB::beginTransaction();
        try {
            EstadoPedido::Create([
                'pedido_id' => $this->pedido_id,
                'estado_id' => $this->selectedNewEstado,
                'fecha_inicio' => $fecha,
                'fecha_final' => $fecha,
                'observaciones' => substr($this->newEstadoObservaciones,0,1000)
            ]);

            Pedido::where('id', $this->pedido_id)
                    ->update([
                        'estado_id' => $this->selectedNewEstado,
                        'estado_nombre' => $this->newEstadoNombre,
                        'estado_fecha' => $fecha,
                    ]);

            // Si el nuevo Estado = TERMINADA -> genero el registro en la tabla TRABAJOS
            if($this->selectedNewEstado == $this->estado_terminada) {
                $this->createTrabajo();

                $this->color_status = "success";
                $msg = "El Trabajo se a creado correctamente";
            }

            DB::commit();

            $this->estado_id = $this->selectedNewEstado;
            $this->estado_nombre = $this->newEstadoNombre;

        } catch (Throwable $e) {
            
            // dd($e);

            DB::rollBack();
            $this->color_status = "danger";
            $msg = "Se ha producido un error. No se pudo generar la OT. Revise los datos y vuelvalo a intentar.";

            // Mostrar mensaje de error
        }

        $this->dispatchBrowserEvent('close-modal');

        return back()->with('status', $msg);
    }

    public function createTrabajo() {
        //
        // Se crea un registro en la tabla TRABAJOS cuando el PEDIDO se pasa al estado TERMINADO
        //
        // Me posiciono sobre el Pedido seleccionado
        $pedido = Pedido::find($this->pedido_id);

        $color_id_1 = null;
        $color_id_2 = null;
        $color_id_3 = null;
        $color_id_4 = null;
        $color_nombre_1 = null;
        $color_nombre_2 = null;
        $color_nombre_3 = null;
        $color_nombre_4 = null;

        if ($pedido->color_id_1) {
            $color_id_1 = $pedido->color_id_1;
            $color_nombre_1 = Color::nombre($pedido->color_id_1);
        }
        if ($pedido->color_id_2) {
            $color_id_2 = $pedido->color_id_2;
            $color_nombre_2 = Color::nombre($pedido->color_id_2);
        }
        if ($pedido->color_id_3) {
            $color_id_3 = $pedido->color_id_3;
            $color_nombre_3 = Color::nombre($pedido->color_id_3);
        }
        if ($pedido->color_id_4) {
            $color_id_4 = $pedido->color_id_4;
            $color_nombre_4 = Color::nombre($pedido->color_id_4);
        }

        // 'color_id_2' => $pedido->color_id_2,
        //     'color_nombre_2' => Color::nombre($pedido->color_id_2),
        //     'color_id_3' => $pedido->color_id_3,
        //     'color_nombre_3' => Color::nombre($pedido->color_id_3),
        //     'color_id_4' => $pedido->color_id_4,
        //     'color_nombre_4' => Color::nombre($pedido->color_id_4),

        // Creo el nuevo trabajo (obvio esto se deberia poder hacer mas facil)
        Trabajo::Create([
            'pedido_id' => $this->pedido_id,
            'numero_ot' => $pedido->numero_ot,
            'fecha_pedido' => date('Y/m/d H:i:s', strtotime($pedido->fecha_pedido)),
            'fecha_entrega' => date('Y/m/d H:i:s', strtotime($pedido->fecha_entrega)),
            'cliente_id' => $pedido->cliente_id,
            'razonsocial' => $pedido->razonsocial,
            'estado_id' => $pedido->estado_id,
            'estado_nombre' => $pedido->estado_nombre,
            'estado_fecha' => $pedido->estado_fecha,
            'trabajo_nombre' => $pedido->trabajo_nombre,
            'ancho' => $pedido->ancho,
            'largo' => $pedido->largo,
            'espesor' => $pedido->espesor,


            'densidad_id' => $pedido->densidad_id,
            'densidad_nombre' => $pedido->densidad_nombre,
            'densidad_pesoespecifico' => $pedido->densidad_pesoespecifico,


            'material_id' => $pedido->material_id,
            'material_nombre' => Material::nombre($pedido->material_id),
            // 'material_pesoespecifico' => $pedido->material_pesoespecifico,
            'color_id' => $pedido->color_id,
            'color_nombre' => Color::nombre($pedido->color_id),


            'color_id_1' => $color_id_1,
            'color_nombre_1' => $color_nombre_1,
            'color_id_2' => $color_id_2,
            'color_nombre_2' => $color_nombre_2,
            'color_id_3' => $color_id_3,
            'color_nombre_3' => $color_nombre_3,
            'color_id_4' => $color_id_4,
            'color_nombre_4' => $color_nombre_4,


            'bolsa_id' => $pedido->bolsa_id,
            'bolsa_nombre' => Bolsa::nombre($pedido->bolsa_id),
            'bolsa_fuelle' => $pedido->bolsa_fuelle,
            'bolsa_largo_fuelle' => $pedido->bolsa_largo_fuelle,
            'tratado_id' => $pedido->tratado_id,
            'tratado_nombre' => Tratado::nombre($pedido->tratado_id),
            'cantidad_bolsas' => $pedido->cantidad_bolsas,
            'corte_id' => $pedido->corte_id,
            'corte_nombre' => Corte::nombre($pedido->corte_id),
            'metros' => $pedido->metros,
            'peso' => $pedido->peso,
            'precio_unitario' => $pedido->precio_unitario,
            'precio_total' => $pedido->precio_total,
            'observaciones' => $pedido->observaciones,

            'observaciones_extrusion' => $pedido->observaciones_extrusion,
            'observaciones_impresion' => $pedido->observaciones_impresion,
            'observaciones_corte' => $pedido->observaciones_corte,

            'trabajo_activo' => $pedido->trabajo_activo,
        ]);
    }
    
    public function reclamoModal() 
    {
        $db = Pedido::select('reclamo','reclamo_inicio', 'reclamo_final', 'reclamo_detalle')
            ->firstWhere('id', $this->pedido_id);

        if($db) {
            $this->reclamo = $db->reclamo;
            $this->reclamo_inicio = $db->reclamo_inicio;
            $this->reclamo_final = $db->reclamo_final;
            $this->reclamo_detalle = $db->reclamo_detalle;
            $this->modal_title = "RECLAMO";
        } else {
            $this->modal_title = "NUEVO RECLAMO";
        }

        $this->modal_width = 'lg';

        $this->resetErrorBag();
        $this->resetValidation();

        $this->dispatchBrowserEvent('show-reclamo-modal');
    }

    public function grabarReclamo() 
    {
        $this->validate(
            [
                'reclamo_detalle' => 'required|string|max:2000',
            ],
            [
                'reclamo_detalle' => [
                    'required' => 'El Reclamo no puede quedar vacio.',
                    'max' => 'Puede ingresar hasta 2 caracteres.',
                ],
            ],
            [
                'reclamo_detalle' => 'Detalle del reclamo',
            ]
        );

        $this->reclamo = true;

        Pedido::where('id', $this->pedido_id)
            ->update([
                'reclamo' => true,
                'reclamo_inicio' => now()->format('Y-m-d H:i:s'),
                'reclamo_detalle' => trim($this->reclamo_detalle),
            ]);

        $this->reset('reclamo','reclamo_inicio', 'reclamo_final', 'reclamo_detalle');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function finalizarReclamo() 
    {
        $this->validate(
            [
                'reclamo_detalle' => 'required|string|max:2000',
            ],
            [
                'reclamo_detalle' => [
                    'required' => 'El Reclamo no puede quedar vacio.',
                    'max' => 'Puede ingresar hasta 2 caracteres.',
                ],
            ],
            [
                'reclamo_detalle' => 'Detalle del reclamo',
            ]
        );

        $this->reclamo = true;

        // dd($this->reclamo_detalle . '\n' . 'FINALIZADO');

        Pedido::where('id', $this->pedido_id)
            ->update([
                'reclamo' => true,
                'reclamo_final' => now()->format('Y-m-d H:i:s'),
                'reclamo_detalle' => trim($this->reclamo_detalle) . PHP_EOL . 'RECLAMO FINALIZADO.',
            ]);

        $this->reset('reclamo','reclamo_inicio', 'reclamo_final', 'reclamo_detalle');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancelModalReclamo() 
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->reset('reclamo','reclamo_inicio', 'reclamo_final', 'reclamo_detalle');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editarReclamoxxx($action) {
        if($this->pedido_id !== null)      // Es un ALTA
        {
            if ($action == 'cerrar') {
                $this->dispatchBrowserEvent('cerrar-reclamo', [
                    'msg' => '¿Desea cerrar el reclamo?'
                ]);
            } else {
                $this->validate(
                    [
                        'reclamo_detalle' => 'string|max:2000',
                    ],
                    [
                        'reclamo_detalle' => [
                            'required' => 'El Reclamo no puede quedar vacio.',
                            'max' => 'Puede ingresar hasta 2 caracteres.',
                        ],
                    ],
                    [
                        'reclamo_detalle' => 'Detalle del reclamo',
                    ]
                );

                $this->reclamo = true;
                Pedido::where('id', $this->pedido_id)
                ->update([
                    'reclamo' => true,
                    'reclamo_inicio' => now()->format('Y-m-d H:i:s'),
                    'reclamo_detalle' => trim($this->reclamo_detalle),
                    ]);

                $this->reset('reclamo','reclamo_inicio', 'reclamo_final', 'reclamo_detalle');
                $this->dispatchBrowserEvent('close-modal');
            }

        }
    }

    public function cerrarReclamo() {
        $this->reclamo = false;
        $this->reclamo_detalle = '';

        $this->updateReclamo();
    }

    public function updateReclamo() {
        Pedido::where('id', $this->pedido_id)
                ->update([
                    'reclamo' => true,
                    'reclamo_inicio' => now()->format('Y-m-d H:i:s'),
                    'reclamo_detalle' => trim($this->reclamo_detalle),
            ]);

        $this->reset('reclamo','reclamo_inicio', 'reclamo_final', 'reclamo_detalle');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete() 
    {
        Pedido::where('id', $this->pedido_id)
                ->update(['anulada' => true]);

        $this->dispatchBrowserEvent('close-modal');
        // // session()->flash('message', 'Registro borrado exitosamente '.$this->pedido_id);
        $this->reset('pedido_id', 'selectedRow', 'estado_id');
    }
    
    public function cancelModal() 
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->dispatchBrowserEvent('close-modal');
        // $this->reset('reclamo','reclamo_detalle');
    }

    public function asignarId($id) {
        $reg = Pedido::find($id);

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

    // public function paginationView()
    // {
    //     return 'custom-pagination';
    // }
}
