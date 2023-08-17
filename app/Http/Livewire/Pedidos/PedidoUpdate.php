<?php 

namespace App\Http\Livewire\Pedidos;

use Throwable;
use App\Models\Bolsa;
use App\Models\Color;
use App\Models\Corte;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Densidad;
use App\Models\Tratado;
use Livewire\Component;
use App\Models\Material;
use App\Models\EstadoPedido;
use App\Models\Trabajo;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

class PedidoUpdate extends Component
{
    // Modales
    public $modal_title;
    public $modal_action;
    public $modal_content;
    public $modal_width = 'md';
    public $btnDesactivar = true;

    // Variables para el ESTADO
    // public $estado_id = 1;
    // public $estado_nombre = "CARGADA";
    // public $estado_fecha = $this->fecha_pedido;
    public $estado_id, $estado_nombre, $estado_fecha;

    // Color notificaciones
    public $color_status = 'danger';        // Color para el alerta de mensajes via status

    // Estado TRABAJOS
    public $activar_trabajo;
    public $trabajo_boton_activar;
    public $trabajo_cantidad_activos;
    public $trabajo_cantidad_desactivos;

    // Estados
    public $estado_cargada = 1;
    public $estado_cargada_nombre = 'CARGADA';
    public $estado_generada = 2;
    public $estado_en_proceso = 3;
    public $estado_terminada = 4;
    public $estado_facturado = 5;
    public $estado_entregada = 6;
    public $estado_anulada = 7;

    // Variables de MODELOS
    public $clientes;
    public $colores;
    public $densidades;
    public $materiales;
    public $bolsas;
    public $tratados;
    public $cortes;
    public $articulos_ot = [];      // Conjunto de articulos obtenidos de la ORDEN DE TRABAJO

    // CREATE CLIENTE
    public $cliente_razonsocial = null;
    public $cliente_cuit = null;
    public $cliente_telefono1 = null;
    public $cliente_correo = null;
    public $cliente_calle_nombre = null;
    public $cliente_calle_numero = null;
    public $cliente_codigo_postal = null;
    public $cliente_barrio_nombre = null;
    public $cliente_localidad_nombre = null;

    // CREATE COLOR
    public $color_nuevo = null;

    // Campos formulario
    public $selectedArticulo;       // ID del articulo seleccionado de la lista de trabajos
    public $pedido_id = null;     // ID de la OT en edicion
    public $title;                  // Titulo del formulario
    public $action = null;
    public $selectedCliente, $cliente_id, $cliente_nombre;
    public $numero_ot, $numero_ot_mensual;
    public $fecha_pedido, $fecha_entrega;
    public $mes, $med_id;
    public $trabajo_nombre;
    public $ancho, $largo, $espesor;
    public $selectedBolsa, $bolsa_id, $bolsa_nombre, $bolsa_fuelle, $bolsa_largo_fuelle;
    public $selectedDensidad, $densidad_id, $densidad_nombre, $densidad_pesoespecifico;
    public $selectedMaterial, $material_id, $material_nombre;
    public $selectedColor, $color_id, $color_nombre;
    public $selectedColor1, $color_id_1, $color_nombre_1;
    public $selectedColor2, $color_id_2, $color_nombre_2;
    public $selectedColor3, $color_id_3, $color_nombre_3;
    public $selectedColor4, $color_id_4, $color_nombre_4;
    public $selectedTratado, $tratado_id, $tratado_nombre, $tratado_formula;
    public $selectedCorte, $corte_id, $corte_nombre;
    public $cantidad_bolsas, $metros, $peso, $precio_unitario, $precio_total;
    public $observaciones, $observaciones_extrusion, $observaciones_impresion, $observaciones_corte;
    public $trabajo_activo;

    // RECLAMOS
    public $reclamosCliente = [];       // Lista de reclamos para el cliente seleccionado
    public $selectedReclamo;
    public $cantReclamosCliente = 0;    // Cant. de reclamos del cliente
    public $reclamoDetalle = null;


    protected $listeners = [
        'updateTratado' => 'updatedselectedTratado',
        'updateTipoBolsa' => 'updatedselectedBolsa',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'fecha_pedido' => 'required|date',
        'fecha_entrega' => 'date|after_or_equal:fecha_pedido' ,
        'selectedCliente' => 'required',
        'cantidad_bolsas' => 'required|numeric|between:1,99999',
        // 'trabajo_nombre' => 'required|alpha:ascii|max:200',
        'trabajo_nombre' => 'required|string|max:200',
        'ancho' => 'required|numeric|between:1,99999',
        'largo' => 'required|numeric|between:1,99999',
        'espesor' => 'required|numeric|between:1,99999',
        'selectedColor' => 'required',
        'selectedMaterial' => 'required',
        'selectedBolsa' => 'required',
        'selectedTratado' => 'required',
        'selectedCorte' => 'required',
        'selectedDensidad' => 'required',
        'bolsa_largo_fuelle' => 'numeric|between:1,99999',
        'precio_unitario' => 'numeric|nullable|between:1,999999',
        'observaciones' => 'nullable|string|max:500',
        'observaciones_extrusion' => 'nullable|string|max:500',
        'observaciones_impresion' => 'nullable|string|max:500',
        'observaciones_corte' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'selectedCliente.required' => 'Debe seleccionar un CLIENTE.',
        'fecha_pedido.required' => 'Debe ingresar la Fecha del Pedido',
        'fecha_pedido.date' => 'Debe ingresar una fecha válida',
        'fecha_entrega.date' => 'Debe ingresar una fecha válida',
        'fecha_entrega.after_or_equal' => 'La :attribute debe ser mayor a la Fecha del Pedido',
        'cantidad_bolsas' => [
            'required' => 'Debe ingresar un número',
            'numeric' => 'Debe ingresar un valor numérico',
            'between' => 'Debe ingresar un valor entre 1 y 99999',
        ],
        'trabajo_nombre' => [
            'required' => 'Debe ingresar un valor',
            'alpha_num' => 'Debe ingresar letras y números',
            // 'string' => 'Debe ingresar solo letras',
            'max' => 'Debe ingresar 100 caracteres como máximo',
        ],
        'ancho' => [
            'required' => 'Debe ingresar un numero',
            'between' => 'Debe ingresar un valor entre 1 y 99999',
        ],
        'largo' => [
            'required' => 'Debe ingresar un numero',
            'between' => 'Debe ingresar un valor entre 1 y 99999',
        ],
        'espesor' => [
            'required' => 'Debe ingresar un numero',
            'between' => 'Debe ingresar un valor entre 1 y 99999',
        ],
        'selectedColor.required' => 'Debe seleccionar un valor.',
        'selectedMaterial.required' => 'Debe seleccionar un valor.',
        'selectedBolsa.required' => 'Debe seleccionar un valor.',
        'selectedTratado.required' => 'Debe seleccionar un valor.',
        'selectedCorte.required' => 'Debe seleccionar un valor.',
        'selectedDensidad.required' => 'Debe seleccionar un valor.',
        'precio_unitario.numeric' => 'Debe ingresar valor numerico',
        'observaciones.max' => 'Debe ingresar un máximo de 2000 caracteres',
        'observaciones_extrusion.max' => 'Debe ingresar un máximo de 2000 caracteres',
        'observaciones_impresion.max' => 'Debe ingresar un máximo de 2000 caracteres',
        'observaciones_corte.max' => 'Debe ingresar un máximo de 2000 caracteres',
        // CREATE CLIENTE
        'cliente_razonsocial' => [
            'required' => 'Debe ingresar un valor',
            // 'alpha' => 'Debe ingresar letras y números',
            'string' => 'Debe ingresar letras y números',
            'min' => 'Debe ingresar mas de 3 caracteres',
            'max' => 'Debe ingresar 100 caracteres como máximo',
        ],
        'cliente_cuit' => [
            'required' => 'Debe ingresar un valor',
            'string' => 'Debe ingresar letras y números',
            'max' => 'Debe ingresar hasta 13 caracteres como máximo',
        ],
        'cliente_telefono1' => [
            'required' => 'Debe ingresar un valor',
            'string' => 'Debe ingresar letras y números',
            'max' => 'Debe ingresar hasta 20 caracteres como máximo',
        ],
        'cliente_correo' => [
            'required' => 'Debe ingresar un valor',
            'string' => 'Debe ingresar letras y números',
            'max' => 'Debe ingresar hasta 100 caracteres como máximo',
        ],

        // 'cliente_telefono1' => 'required|string|between:5,30',
        // 'cliente_correo' => 'required|email|max:100|unique:clientes,correo',
        // 'cliente_calle_nombre' => 'nullable|string|between:3,100',
        // 'cliente_calle_numero' => 'nullable|digits_between:1,5',
        // 'cliente_codigo_postal' => 'nullable|alpha_num|between:4,20',
        // 'cliente_barrio_nombre' => 'nullable|string|between:3,100',
        // 'cliente_localidad_nombre' => 'nullable|string|between:3,100',

        // CREATE COLOR
        'color_nuevo' => [
            'required' => 'Debe ingresar un valor',
            'string' => 'Debe ingresar letras y números',
            'min' => 'Debe ingresar mas de 3 caracteres',
            'max' => 'Debe ingresar 100 caracteres como máximo',
        ],
    ];

    protected $validationAttributes = [
        'fecha_pedido' => 'Fecha del Pedido',
        'fecha_entrega' => 'Fecha de Entrega',
        'selectedCliente' => 'CLIENTE',
        'selectedColor' => 'COLOR',
        'trabajo_nombre' => 'Nombre Trabajo',
        'ancho' => 'Ancho',
        'largo' => 'Largo',
        'espesor' => 'Espesor',
        'ancho' => 'Ancho',
        'precio_unitario' => 'Precio Unitario',
        'cantidad_bolsas' => 'Cantidad de Bolsas',
        'observaciones' => 'Observaciones',
    ];

    public function mount($action, $id) {

        $this->pedido_id = $id;
        $this->action = $action;

        $this->bolsa_fuelle = false;
        $this->bolsa_largo_fuelle = 0;
        $this->tratado_formula = 0;
        $this->densidad_pesoespecifico = 0;

        $this->clientes = Cliente::select('id','razonsocial')
                            ->orderBy('razonsocial', 'asc')
                            ->get();
        $this->colores = Color::select('*')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->densidades = Densidad::select('*')
                            ->orderBy('densidad', 'asc')
                            ->get();                            
        $this->materiales = Material::select('*')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->bolsas = Bolsa::select('*')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->tratados = Tratado::select('*')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->cortes = Corte::select('*')
                            ->orderBy('nombre', 'asc')
                            ->get();

        switch ($this->action) {
            case 'create';
                $this->estado_id = $this->estado_cargada;
                $this->estado_nombre = $this->estado_cargada_nombre;
                $this->estado_fecha = $this->fecha_pedido;

                $this->title = "Nueva ORDEN de TRABAJO";
                break;
            case 'edit';
                $this->title = "Edición ORDEN DE TRABAJO";
                $this->asignarCampos();
                break;
            case 'show';
                $this->title = "Datos ORDEN DE TRABAJO";
                $this->asignarCampos();
                break;
            default:
                break;
        }
    }

    public function render()
    {
        // return view('livewire.orden-trabajo.orden-trabajo-create');
        return view('livewire.pedidos.pedido-update');
    }

    public function asignarCampos() 
    {
        // Carga los campos del modelo a las variables del formulario.
        // Es un perno, seguro se puede de otra forma.
        //
        $reg = Pedido::select('*')
                    ->where('id',$this->pedido_id)
                    ->first();
                    
        // dd(date('Y-m-d', strtotime($reg->estado_fecha)));

        if ($reg->count() > 0) {
            $this->numero_ot = $reg->numero_ot;
            $this->numero_ot_mensual = $reg->numero_ot_mensual;
            $this->fecha_pedido = date('Y-m-d', strtotime($reg->fecha_pedido));
            $this->fecha_entrega = date('Y-m-d', strtotime($reg->fecha_entrega));
            $this->selectedCliente = $reg->cliente_id;
            $this->cliente_nombre = $reg->razonsocial;
            $this->estado_id = $reg->estado_id;
            $this->estado_nombre = $reg->estado_nombre;
            $this->estado_fecha = date('Y-m-d', strtotime($reg->estado_fecha));
            $this->trabajo_nombre = $reg->trabajo_nombre;
            $this->ancho = $reg->ancho;
            $this->largo = $reg->largo;
            $this->espesor = $reg->espesor;
            $this->selectedDensidad = $reg->densidad_id;
            $this->densidad_pesoespecifico = $reg->densidad_pesoespecifico;
            $this->selectedMaterial = $reg->material_id;
            $this->material_nombre = $reg->material_nombre;
            $this->selectedColor = $reg->color_id;
            $this->selectedColor1 = $reg->color_id_1;
            $this->selectedColor2 = $reg->color_id_2;
            $this->selectedColor3 = $reg->color_id_3;
            $this->selectedColor4 = $reg->color_id_4;
            $this->color_nombre_1 = $reg->color_nombre_1;
            $this->color_nombre_2 = $reg->color_nombre_2;
            $this->color_nombre_3 = $reg->color_nombre_3;
            $this->color_nombre_4 = $reg->color_nombre_4;
            $this->selectedBolsa = $reg->bolsa_id;
            $this->bolsa_largo_fuelle = $reg->bolsa_largo_fuelle;
            $this->selectedTratado = $reg->tratado_id;
            $this->selectedCorte = $reg->corte_id;
            $this->cantidad_bolsas = $reg->cantidad_bolsas;
            $this->metros = round($reg->metros,2);
            $this->peso = round($reg->peso,2);
            $this->precio_unitario = $reg->precio_unitario;
            $this->observaciones = $reg->observaciones;
            $this->observaciones_extrusion = $reg->observaciones_extrusion;
            $this->observaciones_impresion = $reg->observaciones_impresion;
            $this->observaciones_corte = $reg->observaciones_corte;
            $this->trabajo_activo = $reg->trabajo_activo;

            // Actualizo los combos para no tener problemas en las formulas.
            $reg2 = $this->tratados->find($reg->tratado_id);
            $this->tratado_nombre = $reg2->nombre;
            $this->tratado_formula = $reg2->formula;

            $reg3 = $this->densidades->find($reg->densidad_id);
            $this->densidad_pesoespecifico = $reg3->pesoespecifico;
            $this->densidad_nombre = $reg3->nombre;

            $reg4 = $this->bolsas->find($reg->bolsa_id);
            $this->bolsa_nombre = $reg4->nombre;
            $this->bolsa_fuelle = $reg4->fuelle;

            $this->trabajo_cantidad_activos = Trabajo::cantidadActivos($this->selectedCliente, true);
            $this->trabajo_cantidad_desactivos = Trabajo::cantidadActivos($this->selectedCliente, false);
            $this->cantReclamosCliente = Pedido::getReclamosCliente($this->selectedCliente);

        }
    }
    
    public function updatedFechaPedido($value) {
        $aMes = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
        $mes = date('n', strtotime($value));
        $año = date('Y', strtotime($value));
        $this->numero_ot_mensual = Pedido::ultimaOt($mes) + 1;
        // $this->numero_ot = $aMes[date('n', strtotime($value))-1] . '-' . $this->numero_ot_mensual;
        $this->numero_ot = $aMes[$mes-1] . '-' . $año . '-' . $this->numero_ot_mensual;
        // dd($this->numero_ot);
        // $this->numero_ot = Pedido::mesPedido($value);
        // dd(Pedido::mesPedido($value));

        // date_default_timezone_set('America/Argentina/Cordoba');
        // setlocale( LC_ALL, "Spanish_Argentina.1252" );
        
        // dd(date('F', strtotime($value)));
        // dd(strtotime($value->format('Y')));
        // dd(date('F', now()));
    }

    public function updatedselectedCliente($value) {
        // if($value ==! null) {
            $cliente = $this->clientes->find($value);
            $this->cliente_nombre = $cliente->razonsocial;
            $this->trabajo_cantidad_activos = Trabajo::cantidadActivos($this->selectedCliente, true);
            $this->trabajo_cantidad_desactivos = Trabajo::cantidadActivos($this->selectedCliente, false);
            $this->cantReclamosCliente = Pedido::getReclamosCliente($this->selectedCliente);
            // Aca busco los reclamos
        // } else {
        //     $this->reset(['cliente_nombre']);
        // }
    }

    public function updatedCantidadBolsas($value) {
        // if($value <> 0) {
        //     // $this->cantidad_bolsas = $value;
        // } else {
        //     $this->reset(['cantidad_bolsas', 'metros', 'peso']);
        // }
        $this->calcularMetros();
        $this->calcularPeso();
    }

    public function updatedselectedDensidad($value) {
        if($value ==! null) {
            $db = $this->densidades->find($value);
            $this->densidad_pesoespecifico = $db->pesoespecifico;
            $this->densidad_nombre = $db->nombre;
            // dd($this->densidad_nombre . ' ' . $this->densidad_pesoespecifico);
        } else {
            $this->reset(['densidad_pesoespecifico', 'densidad_nombre', 'peso']);
        }

        $this->calcularPeso();
    }

    public function updatedselectedMaterial($value) {
        if ($value ==! null) {
            $db = $this->materiales->find($value);
            $this->material_nombre = $db->nombre;
            // dd($this->material_nombre);
        } else {
            $this->reset(['material_nombre']);
        }
    }

    public function updatedselectedColor($value) {
        if ($value ==! null) {
            $color = $this->colores->find($value);
            $this->color_nombre = $color->nombre;
        } else {
            $this->reset(['color_nombre']);
        }
    }

    public function updatedselectedColor1($value) {
        if ($value ==! null) {
            $color = $this->colores->find($value);
            $this->color_nombre_1 = $color->nombre;
            // dd($this->color_nombre_1);
        } else {
            $this->reset(['color_nombre_1']);
        }
    }
    public function updatedselectedColor2($value) {
        if ($value ==! null) {
            $color = $this->colores->find($value);
            $this->color_nombre_2 = $color->nombre;
        } else {
            $this->reset(['color_nombre_2']);
        }
    }
    public function updatedselectedColor3($value) {
        if ($value ==! null) {
            $color = $this->colores->find($value);
            $this->color_nombre_3 = $color->nombre;
        } else {
            $this->reset(['color_nombre_3']);
        }
    }
    public function updatedselectedColor4($value) {
        if ($value ==! null) {
            $color = $this->colores->find($value);
            $this->color_nombre_4 = $color->nombre;
        } else {
            $this->reset(['color_nombre_4']);
        }
    }

    public function updatedselectedBolsa($value) {
        if($value ==! null) {
            $bolsa = $this->bolsas->find($value);
            $this->bolsa_nombre = $bolsa->nombre;
            $this->bolsa_fuelle = $bolsa->fuelle;
            $this->bolsa_largo_fuelle = '';
        } else {
            $this->reset(['bolsa_nombre', 'bolsa_fuelle', 'bolsa_largo_fuelle']);
        }
    }

    public function updatedselectedTratado($value) {
        if ($value ==! null) {
            $tratado = $this->tratados->find($value);
            $this->tratado_nombre = $tratado->nombre;
            $this->tratado_formula = $tratado->formula;
        } else {
            $this->reset(['tratado_nombre', 'tratado_formula', 'metros']);
        }
        $this->calcularMetros();
    }

    public function updatedselectedCorte($value) {
        if ($value ==! null) {
            $corte = $this->cortes->find($value);
            $this->corte_nombre = $corte->nombre;
        } else {
            $this->reset(['corte_nombre']);
        }
        $this->calcularMetros();
    }

    public function updatedEspesor($value) {
        if($value == false) {
            $this->reset(['espesor', 'peso']);
        }
        $this->calcularPeso();
    }

    public function updatedAncho($value) {
        if($value == false) {
            $this->reset(['ancho', 'peso']);
        }
        $this->calcularPeso();
    }

    public function updatedLargo($value) {
        // if($value == false) {
        //     $this->reset(['largo', 'metros', 'peso']);
        // }
        $this->calcularMetros();
        $this->calcularPeso();
    }

    public function calcularMetros() {
        // Metros = cant. bolsas * (largo/100) * tratado
        // if(!is_numeric($this->cantidad_bolsas)) {
        //     $this->cantidad_bolsas = null;
        // }
        // if(!is_numeric($this->largo)) {
        //     $this->largo = null;
        // }
        // if(!is_numeric($this->tratado_formula)) {
        //     $this->tratado_formula = null;
        // }

        // if(is_numeric($this->cantidad_bolsas) && is_numeric($this->largo) && is_numeric($this->tratado_formula)) {
        //     $this->metros = round($this->cantidad_bolsas * ($this->largo/100) * $this->tratado_formula, 2);
        // } else {
        //     $this->metros = 0;
        // }

        $this->metros = round($this->cantidad_bolsas * ($this->largo/100) * $this->tratado_formula,2);
        // dd($this->cantidad_bolsas . ' - ' . ($this->largo/100) . ' - ' . $this->tratado_formula);
    }

    public function calcularPeso() {
        // Peso = (((Ancho/100) * (Largo/100) * Espesor * Peso Especifico) * Cant. Bolsas) / 1000
        if(!is_numeric($this->ancho)) {
            $this->ancho = null;
        }
        if(!is_numeric($this->largo)) {
            $this->largo = null;
        }
        if(!is_numeric($this->espesor)) {
            $this->espesor = null;
        }
        if(!is_numeric($this->densidad_pesoespecifico)) {
            $this->densidad_pesoespecifico = null;
        }
        if(!is_numeric($this->cantidad_bolsas)) {
            $this->cantidad_bolsas = null;
        }

        $this->peso = round(((($this->ancho/100) * ($this->largo/100) * $this->espesor * $this->densidad_pesoespecifico) * $this->cantidad_bolsas) / 1000,2);
    }

    public function reclamosModal($cliente) 
    {
        // Muestra la lista de reclamos para el cliente seleccionado.

        $this->modal_title = "LISTA DE RECLAMOS";
        $this->modal_width = 'lg';

        $this->reclamosCliente = Pedido::showReclamosCliente($cliente);

        $this->dispatchBrowserEvent('show-reclamos-modal');
    }

    public function showReclamoDetalle($id) {
        $this->reset('reclamoDetalle');
        $this->reclamoDetalle = Pedido::getReclamoDetalle($id);
    }

    public function cancelReclamoModal() {

        $this->dispatchBrowserEvent('close-modal');
        $this->reset('reclamoDetalle');
    }

    public function trabajosModal($cliente, $estado) {

        if ($estado == 1) {
            $this->activar_trabajo = true;
            $this->modal_title = "LISTA DE TRABAJOS";
            $this->trabajo_boton_activar = "Desactivar trabajo";
        } else {
            $this->activar_trabajo = false;
            $this->modal_title = "LISTA DE TRABAJOS DESACTIVADOS";
            $this->trabajo_boton_activar = "Activar trabajo";
        }

        $this->modal_width = 'lg';

        $this->queryArticulosOT($cliente, $estado);

        $this->dispatchBrowserEvent('show-articulos-modal');
    }

    public function cambiarEstadoTrabajo() {

        Trabajo::where('id',$this->selectedArticulo)
             ->update(['trabajo_activo' => !$this->activar_trabajo]);
        
        $this->queryArticulosOT($this->selectedCliente, $this->activar_trabajo);

        $this->trabajo_cantidad_activos = Trabajo::cantidadActivos($this->selectedCliente, true);
        $this->trabajo_cantidad_desactivos = Trabajo::cantidadActivos($this->selectedCliente, false);

        $this->reset('selectedArticulo', 'btnDesactivar');
    }

    public function queryArticulosOT($id, $value) {
        $this->articulos_ot = Trabajo::query()
            ->where('cliente_id', $id)
            ->where('trabajo_activo', $value)
            ->with('material:id,nombre','color:id,nombre','bolsa:id,nombre','tratado:id,nombre','corte:id,nombre')
            // ->select('id','fecha_pedido','trabajo_nombre','ancho','largo','espesor','bolsa_largo_fuelle','material_id','color_id','bolsa_id','tratado_id', 'corte_id','trabajo_activo','estado_id','estado_nombre')
            // ->select('id','fecha_pedido','trabajo_nombre','ancho','largo','espesor','bolsa_largo_fuelle','material_id','color_id','bolsa_id','tratado_id', 'corte_id','trabajo_activo')
            ->select('id','fecha_pedido','trabajo_nombre','ancho','largo','espesor','bolsa_largo_fuelle','material_id','color_id','bolsa_id','tratado_id', 'corte_id','trabajo_activo')
            ->orderBy('fecha_pedido', 'asc')
            ->get();
    }

    public function grabarOT() {
        if($this->action == 'create')      // Es un ALTA
        {
            $this->estado_id = $this->estado_cargada;
            $this->estado_nombre = $this->estado_cargada_nombre;
            $this->estado_fecha = now()->format('Y-m-d H:i:s');
        }
        // $this->validate(
        //     [
        //         'reclamo_detalle' => 'required|string|max:2000',
        //     ],
        //     [
        //         'reclamo_detalle' => [
        //             'required' => 'El Reclamo no puede quedar vacio.',
        //             'max' => 'Puede ingresar hasta 2 caracteres.',
        //         ],
        //     ],
        //     [
        //         'reclamo_detalle' => 'Detalle del reclamo',
        //     ]
        // );
       

        $this->validate();

        $fecha = now()->format('Y-m-d H:i:s');

        DB::beginTransaction();

        try {
            $aux = Pedido::updateOrCreate(['id' => $this->pedido_id],
            [
                'numero_ot' => $this->numero_ot,
                'numero_ot_mensual' => $this->numero_ot_mensual,
                // $this->fecha_pedido = date('Y-m-d', strtotime($reg->fecha_pedido));
                // $this->fecha_entrega = date('Y-m-d', strtotime($reg->fecha_entrega));
                'fecha_pedido' => $this->fecha_pedido,
                'fecha_entrega' => $this->fecha_entrega,
                'cliente_id' => $this->selectedCliente,
                'razonsocial' => $this->cliente_nombre,
                'estado_id' => $this->estado_id,
                'estado_nombre' => $this->estado_nombre,
                'estado_fecha' => $this->estado_fecha,
                'trabajo_nombre' => $this->trabajo_nombre,
                'ancho' => $this->ancho,
                'largo' => $this->largo,
                'espesor' => $this->espesor,
                'densidad_id' => $this->selectedDensidad,
                'densidad_nombre' => $this->densidad_nombre,
                'densidad_pesoespecifico' => $this->densidad_pesoespecifico,
                'material_id' => $this->selectedMaterial,
                'material_nombre' => $this->material_nombre,
                'color_id' => $this->selectedColor,
                'color_nombre' => $this->color_nombre,
                'color_id_1' => $this->selectedColor1,
                'color_nombre_1' => $this->color_nombre_1,
                'color_id_2' => $this->selectedColor2,
                'color_nombre_2' => $this->color_nombre_2,
                'color_id_3' => $this->selectedColor3,
                'color_nombre_3' => $this->color_nombre_3,
                'color_id_4' => $this->selectedColor4,
                'color_nombre_4' => $this->color_nombre_4,
                'bolsa_id' => $this->selectedBolsa,
                'bolsa_nombre' => $this->bolsa_nombre,
                'bolsa_fuelle' => $this->bolsa_fuelle,
                'bolsa_largo_fuelle' => $this->bolsa_largo_fuelle,
                'tratado_id' => $this->selectedTratado,
                'tratado_nombre' => $this->tratado_nombre,
                'cantidad_bolsas' => $this->cantidad_bolsas,
                'corte_id' => $this->selectedCorte,
                'corte_nombre' => $this->corte_nombre,
                'metros' => round($this->metros,2),
                'peso' => round($this->peso,2),
                'precio_unitario' => $this->precio_unitario,
                'precio_total' => $this->precio_total,
                'observaciones' => $this->observaciones,
                'observaciones_extrusion' => $this->observaciones_extrusion,
                'observaciones_impresion' => $this->observaciones_impresion,
                'observaciones_corte' => $this->observaciones_corte,
                'trabajo_activo' => true,
            ]);

            // Si es un ALTA se deberia obtener el pedido_id del ultimo registro agregado a la tabla PEDIDOS
            // Y de paso, esto solo se deberia ejecutar solo si es un ALTA
            // Tambien se podria preguntar por $this->action
            if ($aux->wasRecentlyCreated) {
                EstadoPedido::Create([
                    'pedido_id' => $aux->id,
                    'estado_id' => $this->estado_id,
                    'fecha_inicio' => $this->estado_fecha,
                    'fecha_final' => $this->estado_fecha,
                    'observaciones' => 'OT CARGADA'
                ]);
            }

            DB::commit();

            // $this->color_status = "danger";
            // $msg = "Se ha producido un error. No se pudo generar la OT. Revise los datos y vuelvalo a intentar.";

        } catch (Throwable $e) {

            // dd($e);

            DB::rollBack();
            
            // $this->color_status = "danger";
            // $msg = "Se ha producido un error. No se pudo generar la OT. Revise los datos y vuelvalo a intentar.";

            // Mostrar mensaje de error
        }        
        return to_route('pedidos.index');

    }

    public function cancelarOT() {
        return redirect()->route('pedidos.index');
    }

    public function selectModal() {

        $reg = Pedido::select()
             ->where('id',$this->selectedArticulo)
             ->first();

        $this->trabajo_nombre = $reg->trabajo_nombre;
        $this->ancho = $reg->ancho;
        $this->largo = $reg->largo;
        $this->espesor = $reg->espesor;
        $this->selectedMaterial = $reg->material_id;
        $this->selectedDensidad = $reg->densidad_id;
        $this->densidad_pesoespecifico = $reg->densidad_pesoespecifico;
        $this->selectedColor = $reg->color_id;
        $this->selectedBolsa = $reg->bolsa_id;
        $this->bolsa_largo_fuelle = $reg->bolsa_largo_fuelle;
        $this->selectedTratado = $reg->tratado_id;
        $this->selectedCorte = $reg->corte_id;

        $this->dispatchBrowserEvent('close-modal');

        $this->emitSelf('updateTratado',$this->selectedTratado);
        $this->emitSelf('updateTipoBolsa',$this->selectedBolsa);

        $this->reset('articulos_ot','selectedArticulo', 'btnDesactivar');

    }

    public function cancelModal() {

        $this->dispatchBrowserEvent('close-modal');
        $this->reset('articulos_ot','selectedArticulo', 'btnDesactivar');

        // $this->resetErrorBag();
        // $this->resetValidation();
    }

    

    public function cancelModalCliente() {

        $this->reset(
            'cliente_razonsocial',
            'cliente_cuit',
            'cliente_telefono1',
            'cliente_correo',
            'cliente_calle_nombre',
            'cliente_calle_numero',
            'cliente_codigo_postal',
            'cliente_barrio_nombre',
            'cliente_localidad_nombre',
        );

        // $this->resetErrorBag();
        // $this->resetValidation();

        $this->dispatchBrowserEvent('close-modal');

    }

    public function clienteModal() {
        
        $this->modal_title = "NUEVO CLIENTE";
        $this->modal_width = 'lg';

        // $this->cancelModal();
        $this->resetErrorBag();

        $this->reset(
            'cliente_razonsocial',
            'cliente_cuit',
            'cliente_telefono1',
            'cliente_correo',
            'cliente_calle_nombre',
            'cliente_calle_numero',
            'cliente_codigo_postal',
            'cliente_barrio_nombre',
            'cliente_localidad_nombre',
        );

        $this->dispatchBrowserEvent('show-cliente-modal');
    }

    public function grabarCliente() {
        
        $this->validate([
            'cliente_razonsocial' => 'required|string|min:3|max:100',
            'cliente_cuit' => 'required|string|max:13',
            'cliente_telefono1' => 'required|string|max:20',
            'cliente_correo' => 'required|email|max:100|unique:clientes,correo',
            // 'cliente_calle_nombre' => 'nullable|string|between:3,100',
            // 'cliente_calle_numero' => 'nullable|digits_between:1,5',
            // 'cliente_codigo_postal' => 'nullable|alpha_num|between:4,20',
            // 'cliente_barrio_nombre' => 'nullable|string|between:3,100',
            // 'cliente_localidad_nombre' => 'nullable|string|between:3,100',
        ]);

        $db = Cliente::Create(
        [
            'razonsocial'=> $this->cliente_razonsocial,
            'cuit' => $this->cliente_cuit,
            'telefono1' => $this->cliente_telefono1,
            'correo' => $this->cliente_correo,
            'calle_nombre' => $this->cliente_calle_nombre,
            'calle_numero' => $this->cliente_calle_numero,
            'codigo_postal' => $this->cliente_codigo_postal,
            'barrio_nombre' => $this->cliente_barrio_nombre,
            'localidad_nombre' => $this->cliente_localidad_nombre,
        ]);

        $this->clientes = Cliente::select('id','razonsocial')
            ->orderBy('razonsocial', 'asc')
            ->get();

        $this->selectedCliente = $db->id;
        $this->cliente_nombre = $db->razonsocial;

        $this->cancelModalCliente();

        // $this->dispatchBrowserEvent('close-modal');
    }

    public function cancelModalColor() {

        $this->reset(
            'color_nuevo',
        );

        $this->resetErrorBag();
        // $this->resetValidation();

        $this->dispatchBrowserEvent('close-modal');

    }

    public function colorModal() {
        
        $this->modal_title = "NUEVO COLOR";
        $this->modal_width = 'md';

        $this->cancelModalColor();
        // $this->reset(
        //     'color_nuevo',
        // );

        $this->dispatchBrowserEvent('show-color-modal');
    }

    public function grabarColor() {
        
        // $this->validate([
        //     'color_nuevo' => 'nullable|required|string|between:3,100',
        // ]);

        $this->validate([
            'color_nuevo' => 'required|string|min:3|max:100',
        ]);


        $db = Color::Create(
        [
            'nombre'=> $this->color_nuevo,
        ]);

        $this->colores = Color::select('*')
            ->orderBy('nombre', 'asc')
            ->get();

        $this->selectedColor = $db->id;

        $this->cancelModalColor();
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    // protected function rules() {
    //     return [
    //             'fecha_pedido' => 'required|date',
    //             'fecha_entrega' => 'date|after_or_equal:fecha_pedido' ,
    //             'selectedCliente' => 'required',
    //             'cantidad_bolsas' => 'required|numeric|between:1,99999',
    //             'trabajo_nombre' => 'string|required|max:200',
    //             'ancho' => 'required|numeric|between:1,99999',
    //             'largo' => 'required|numeric|between:1,99999',
    //             'espesor' => 'required|numeric|between:1,99999',
    //             'selectedColor' => 'required',
    //             'selectedMaterial' => 'required',
    //             'selectedBolsa' => 'required',
    //             'selectedTratado' => 'required',
    //             'selectedCorte' => 'required',
    //             'selectedDensidad' => 'required',
    //             'bolsa_largo_fuelle' => 'numeric|between:1,99999',
    //             'precio_unitario' => 'numeric|nullable|between:1,999999',
    //             'observaciones' => 'string|nullable|max:500',
    //             'observaciones_extrusion' => 'string|nullable|max:500',
    //             'observaciones_impresion' => 'string|nullable|max:500',
    //             'observaciones_corte' => 'string|nullable|max:500',
    //     ];
    // }

    // protected $messages = [
    //     'selectedCliente.required' => 'Debe seleccionar un CLIENTE.',
    //     'fecha_pedido.required' => 'Debe ingresar la Fecha del Pedido',
    //     'fecha_pedido.date' => 'Debe ingresar una fecha válida',
    //     'fecha_entrega.date' => 'Debe ingresar una fecha válida',
    //     'fecha_entrega.after_or_equal' => 'La :attribute debe ser mayor a la Fecha del Pedido',
    //     'cantidad_bolsas' => [
    //         'required' => 'Debe ingresar un número',
    //         'numeric' => 'Debe ingresar un valor numérico',
    //         'between' => 'Debe ingresar un valor entre 1 y 99999',
    //         // 'max' => 'Debe ingresar un valor entre 1 y 99999',
    //     ],
    //     'trabajo_nombre' => [
    //         'required' => 'Debe ingresar un valor',
    //         'max' => 'Debe ingresar 100 caracteres como máximo',
    //     ],
    //     // 'trabajo_nombre.required' => 'Debe ingresar un valor',
    //     // 'ancho' => 'Debe ingresar un valor',
    //     // 'largo' => 'Debe ingresar un valor',
    //     // 'espesor' => 'Debe ingresar un valor',
    //     'ancho' => [
    //         'required' => 'Debe ingresar un numero',
    //         'between' => 'Debe ingresar un valor entre 1 y 99999',
    //     ],
    //     'largo' => [
    //         'required' => 'Debe ingresar un numero',
    //         'between' => 'Debe ingresar un valor entre 1 y 99999',
    //     ],
    //     'espesor' => [
    //         'required' => 'Debe ingresar un numero',
    //         'between' => 'Debe ingresar un valor entre 1 y 99999',
    //     ],

    //     'selectedColor.required' => 'Debe seleccionar un valor.',
    //     'selectedMaterial.required' => 'Debe seleccionar un valor.',
    //     'selectedBolsa.required' => 'Debe seleccionar un valor.',
    //     'selectedTratado.required' => 'Debe seleccionar un valor.',
    //     'selectedCorte.required' => 'Debe seleccionar un valor.',
    //     'selectedDensidad.required' => 'Debe seleccionar un valor.',
    //     'precio_unitario.numeric' => 'Debe ingresar valor numerico',
    //     'observaciones.max' => 'Debe ingresar un máximo de 2000 caracteres',
    //     'observaciones_extrusion.max' => 'Debe ingresar un máximo de 2000 caracteres',
    //     'observaciones_impresion.max' => 'Debe ingresar un máximo de 2000 caracteres',
    //     'observaciones_corte.max' => 'Debe ingresar un máximo de 2000 caracteres',
    // //     // 'numero_ot' => [
    // //     //     'required' => 'Debe ingresar el Nro. de la OT.',
    // //     //     'min' => 'El Nro. de la OT debe ser mayor a 0 (cero)',
    // //     //     'numeric' => 'INGRESE UN VALOR NUMERICO',
    // //     // ],
    // //     'selectedCliente' => [
    // //         'required' => 'Debe seleccionar un CLIENTE.',
    // //     ],
    // //     // 'cliente_razonsocial' => [
    // //     //     'required' => 'Debe ingresar la :attribute',
    // //     // ],
    // //     // 'cliente_correo' => [
    // //     //     'required' => 'Debe ingresar :attribute',
    // //     //     'unique' => 'El Correo ingresado ya existe.'
    // //     // ],
    // //     'trabajo_nomnbre.required' => 'Debe ingresar el Nombre del Trabajo',
    // //     'fecha_pedido.required' => 'Debe ingresar la Fecha del Pedido',
    // //     'fecha_entrega.after_or_equal' => 'La :attribute debe ser mayor a la Fecha del Pedido',
    // //     // 'invitation.email.unique.invitations' => 'The email has already been invited.',
    // //     // 'invitation.email.unique.users' => 'An account with this email has already been registered.',
    // //     // 'text.min' => 'Keep typing...'
    // ];

    // protected $validationAttributes = [
    //     'fecha_pedido' => 'Fecha del Pedido',
    //     'fecha_entrega' => 'Fecha de Entrega',
    //     'selectedCliente' => 'CLIENTE',
    //     'selectedColor' => 'COLOR',
    //     'trabajo_nombre' => 'Nombre Trabajo',
    //     'ancho' => 'Ancho',
    //     'largo' => 'Largo',
    //     'espesor' => 'Espesor',
    //     'ancho' => 'Ancho',
    //     'precio_unitario' => 'Precio Unitario',
    //     'cantidad_bolsas' => 'Cantidad de Bolsas',
    //     'observaciones' => 'Observaciones',

    // //     'fecha_pedido' => 'Fecha del Pedido',
    // //     'fecha_entrega' => 'Fecha de Entrega',
    // //     'selectedCliente' => 'CLIENTE',
    // //     'selectedColor' => 'COLOR',
    // //     'trabajo_nombre' => 'Nombre del Trabajo',
    // //     'ancho' => 'Ancho',
    // //     'largo' => 'Largo',
    // //     'espesor' => 'Espesor',
    // //     'ancho' => 'Ancho',
    // //     'precio_unitario' => 'Precio Unitario',
    // //     'cantidad_bolsas' => 'Cantidad de Bolsas',
    // //     'observaciones' => 'Observaciones',
    // //     // Atributos del Cliente
    // //     'cliente_razonsocial' => 'Razón Social',
    // //     'cliente_cuit' => 'CUIT',
    // //     'cliente_telefono1' => 'Teléfono',
    // //     'cliente_correo' => 'Correo',
    // //     'cliente_calle_nombre' => 'Calle',
    // //     'cliente_calle_numero' => 'Nro.',
    // //     'cliente_codigo_postal' => 'Código Postal',
    // //     'cliente_barrio_nombre' => 'Barrio',
    // //     'cliente_localidad_nombre' => 'Localidad',
    // ];

}
