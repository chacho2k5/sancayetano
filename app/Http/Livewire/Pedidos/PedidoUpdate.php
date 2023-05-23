<?php 

namespace App\Http\Livewire\Pedidos;

use Throwable;
use App\Models\Bolsa;
use App\Models\Color;
use App\Models\Corte;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Tratado;
use Livewire\Component;
use App\Models\Material;
use App\Models\EstadoPedido;
use Illuminate\Support\Facades\DB;

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

    // Estados
    public $estado_cargada = 1;
    public $estado_cargada_nombre = 'CARGADA';
    public $estado_generada = 2;
    public $estado_en_proceso = 3;
    public $estado_terminada = 4;
    public $estado_despachada = 5;
    public $estado_entregada = 6;
    public $estado_anulada = 7;

    // Variables de MODELOS
    public $clientes;
    public $colores;
    public $materiales;
    public $bolsas;
    public $tratados;
    public $cortes;
    public $articulos_ot = [];      // Conjunto de articulos obtenidos de la ORDEN DE TRABAJO

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
    public $selectedMaterial, $material_id, $material_nombre, $material_pesoespecifico;
    public $selectedColor, $color_id, $color_nombre;
    public $selectedTratado, $tratado_id, $tratado_nombre, $tratado_formula;
    public $selectedCorte, $corte_id, $corte_nombre;
    public $cantidad_bolsas, $metros, $peso, $precio_unitario, $precio_total, $observaciones;
    public $trabajo_activo = true;

    protected $listeners = [
        'updateTratado' => 'updatedselectedTratado',
        'updateTipoBolsa' => 'updatedselectedBolsa',
    ];

    public function mount($action, $id) {

        $this->pedido_id = $id;
        $this->action = $action;

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
 
        $this->clientes = Cliente::select('id','razonsocial')
                            ->orderBy('razonsocial', 'asc')
                            ->get();
        $this->colores = Color::select('id','nombre')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->materiales = Material::select('id','nombre')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->bolsas = Bolsa::select('id','nombre')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->tratados = Tratado::select('id','nombre', 'formula')
                            ->orderBy('nombre', 'asc')
                            ->get();
        $this->cortes = Corte::select('id','nombre')
                            ->orderBy('nombre', 'asc')
                            ->get();

    }

    public function render()
    {
        // return view('livewire.orden-trabajo.orden-trabajo-create');
        return view('livewire.pedidos.pedido-update');
    }

    public function asignarCampos() 
    {
        $reg = Pedido::select('*')
                    ->where('id',$this->pedido_id)
                    ->first();
                    
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
            $this->selectedMaterial = $reg->material_id;
            $this->material_pesoespecifico = $reg->material_pesoespecifico;
            $this->selectedColor = $reg->color_id;
            $this->selectedBolsa = $reg->bolsa_id;
            $this->bolsa_largo_fuelle = $reg->bolsa_largo_fuelle;
            $this->selectedTratado = $reg->tratado_id;
            $this->selectedCorte = $reg->corte_id;
            $this->cantidad_bolsas = $reg->cantidad_bolsas;
            $this->metros = $reg->metros;
            $this->peso = $reg->peso;
            $this->observaciones = $reg->observaciones;
            $this->trabajo_activo = $reg->trabajo_activo;
        }
    }
    
    protected function rules() {
        return [
            // 'numero_ot' => 'required|string|max:20',
            'fecha_pedido' => 'required',
            'fecha_entrega' => 'after_or_equal:fecha_pedido' ,
            'selectedCliente' => 'required',
            'trabajo_nombre' => 'required|between:1,80',
            'ancho' => 'required|numeric|between:1,9999',
            'largo' => 'required|numeric|between:1,9999',
            'espesor' => 'required|numeric|between:1,9999',
            'selectedColor' => 'required',
            'selectedMaterial' => 'required',
            'selectedBolsa' => 'required',
            'selectedTratado' => 'required',
            'selectedCorte' => 'required',
            'cantidad_bolsas' => 'required|numeric|between:1,999999',
            'bolsa_largo_fuelle' => 'numeric|between:1,99999',
            'observaciones' => 'string|nullable|max:5000',

        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $validationAttributes = [
        'fecha_pedido' => 'Fecha del Pedido',
        'fecha_entrega' => 'Fecha de Entrega',
        'selectedcliente' => 'CLIENTE',
        'trabajo_nombre' => 'Nombre Trabajo',
        'ancho' => 'Ancho',
        'largo' => 'Largo',
        'espesor' => 'Espesor',
        'ancho' => 'Ancho',
        'cantidad_bolsas' => 'Cantidad de Bolsas',
        'observaciones' => 'Observaciones',
    ];

    protected $messages = [
        // 'numero_ot' => [
        //     'required' => 'Debe ingresar el Nro. de la OT.',
        //     'min' => 'El Nro. de la OT debe ser mayor a 0 (cero)',
        //     'numeric' => 'INGRESE UN VALOR NUMERICO',
        // ],
        'selectedcliente' => [
            'required' => 'Debe seleccionar un CLIENTE.',
        ],
        // 'fecha_pedido.required' => 'Debe ingresar la Fecha del Pedido',
        // 'invitation.email.unique.invitations' => 'The email has already been invited.',
        // 'invitation.email.unique.users' => 'An account with this email has already been registered.',
        // 'text.min' => 'Keep typing...'
    ];

    public function updatedFechaPedido($value) {
        // $fecha = date('d-m-Y', strtotime($value));
        $dia = date('d', strtotime($value));
        $mes = date('m', strtotime($value));
        $año = date('y', strtotime($value));
        
        $this->numero_ot_mensual = Pedido::ultimaOt($mes) + 1;
        $this->numero_ot = $dia . $mes . $año . '-' . $this->numero_ot_mensual;

        // dd($this->numero_ot);
    }

    public function updatedselectedCliente($value) {
        if($value ==! null) {
            $cliente = $this->clientes->find($value);
            $this->cliente_nombre = $cliente->razonsocial;
        } else {
            $this->reset(['cliente_nombre']);
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

    public function updatedselectedMaterial($value) {
        if($value ==! null) {
            $material = $this->materiales->find($value);
            $this->material_pesoespecifico = $material->pesoespecifico;
            $this->material_nombre = $material->nombre;
            // dd($this->material_nombre);
        } else {
            $this->reset(['material_pesoespecifico', 'material_nombre', 'peso']);
        }
        $this->calcularPeso();
    }

    public function updatedselectedBolsa($value) {
        if($value ==! null) {
            $bolsa = $this->bolsas->find($value);
            $this->bolsa_nombre = $bolsa->nombre;
            $this->bolsa_fuelle = $bolsa->fuelle;
        } else {
            $this->reset(['bolsa_nombre', 'bolsa_fuelle']);
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
    
    public function updatedCantidadBolsas($value) {
        if($value <> 0) {
            $this->cantidad_bolsas = $value;
        } else {
            $this->reset(['cantidad_bolsas', 'metros', 'peso']);
        }
        $this->calcularMetros();
        $this->calcularPeso();
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
        if($value == false) {
            $this->reset(['largo', 'metros', 'peso']);
        }
        $this->calcularMetros();
        $this->calcularPeso();
    }

    public function calcularMetros() {
        // Metros = cant. bolsas * (largo/100) * tratado
        $this->metros = $this->cantidad_bolsas * ($this->largo/100) * $this->tratado_formula;
        // dd($this->cantidad_bolsas . ' - ' . ($this->largo/100) . ' - ' . $this->tratado_formula);
    }

    public function calcularPeso() {
        // Peso = (((Ancho/100) * (Largo/100) * Espesor * Peso Especifico) * Cant. Bolsas) / 1000
        $this->peso = ((($this->ancho/100) * ($this->largo/100) * $this->espesor * $this->material_pesoespecifico) * $this->cantidad_bolsas) / 1000;
    }

    public function trabajosModal($cliente) {

        $this->modal_title = "LISTA DE ARTICULOS / TRABAJOS";
        $this->modal_width = 'lg';

        $this->queryArticulosOT($cliente);

        $this->dispatchBrowserEvent('show-articulos-modal');
    }

    public function queryArticulosOT($id) {
        $this->articulos_ot = Pedido::query()
        ->where('cliente_id', $id)
        ->where('trabajo_activo', true)
        ->with('material:id,nombre','color:id,nombre','bolsa:id,nombre','tratado:id,nombre','corte:id,nombre')
        // ->select('id','fecha_pedido','trabajo_nombre','ancho','largo','espesor','bolsa_largo_fuelle','material_id','color_id','bolsa_id','tratado_id', 'corte_id','trabajo_activo','estado_id','estado_nombre')
        ->select('id','fecha_pedido','trabajo_nombre','ancho','largo','espesor','bolsa_largo_fuelle','material_id','color_id','bolsa_id','tratado_id', 'corte_id','trabajo_activo')
        ->orderBy('fecha_pedido', 'asc')
        ->get();
    }

    public function grabarOT() {

        // Con esto controlaba si FECHA_ENTREGA > FECHA_PEDIDO ahora lo hago desde las reglas de validacion
        // if($this->fecha_pedido > $this->fecha_entrega) {
        //     // dd('mostrar alert');
        //     $this->modal_width = 'sm';
        //     $this->modal_title = "PEDIDOS";
        //     $this->modal_content = 'La fecha de entrega no puede ser menor a la fecha del pedido.';
        //     $this->dispatchBrowserEvent('show-alert-modal');
        //     return false;
        // }

        if($this->pedido_id == null)      // Es un ALTA
        {
            $this->estado_id = $this->estado_cargada;
            $this->estado_nombre = $this->estado_cargada_nombre;
            // $this->estado_fecha = $this->fecha_pedido;
            $this->estado_fecha = now();
        }

        $this->validate();

        $fecha = now()->format('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            Pedido::updateOrCreate(['id' => $this->pedido_id],
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
                'material_id' => $this->selectedMaterial,
                'material_nombre' => $this->material_nombre,
                'material_pesoespecifico' => $this->material_pesoespecifico,
                'color_id' => $this->selectedColor,
                'color_nombre' => $this->color_nombre,
                'bolsa_id' => $this->selectedBolsa,
                'bolsa_nombre' => $this->bolsa_nombre,
                'bolsa_fuelle' => $this->bolsa_fuelle,
                'bolsa_largo_fuelle' => $this->bolsa_largo_fuelle,
                'tratado_id' => $this->selectedTratado,
                'tratado_nombre' => $this->tratado_nombre,
                'cantidad_bolsas' => $this->cantidad_bolsas,
                'corte_id' => $this->selectedCorte,
                'corte_nombre' => $this->corte_nombre,
                'metros' => $this->metros,
                'peso' => $this->peso,
                'precio_unitario' => $this->precio_unitario,
                'precio_total' => $this->precio_total,
                'observaciones' => $this->observaciones,
                'trabajo_activo' => $this->trabajo_activo,
            ]);

            // Si es un ALTA se deberia obtener el pedido_id del ultimo registro agregado a la tabla PEDIDOS
            // Y de paso, esto solo se deberia ejecutar solo si es un ALTA
            EstadoPedido::Create([
                'pedido_id' => $this->pedido_id,
                'estado_id' => $this->estado_cargada,
                'fecha_inicio' => $fecha,
                'fecha_final' => $fecha,
                'observaciones' => substr($this->estado_observaciones,0,1000)
            ]);
         
            DB::commit();

            // $this->color_status = "danger";
            // $msg = "Se ha producido un error. No se pudo generar la OT. Revise los datos y vuelvalo a intentar.";

        } catch (Throwable $e) {

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
        $this->material_pesoespecifico = $reg->material_pesoespecifico;
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

    public function desactivarTrabajo() {

        Pedido::where('id',$this->selectedArticulo)
             ->update(['trabajo_activo' => false]);
        
        $this->queryArticulosOT($this->selectedCliente);

        $this->reset('selectedArticulo', 'btnDesactivar');
    }

    public function cancelModal() {

        $this->dispatchBrowserEvent('close-modal');
        $this->reset('articulos_ot','selectedArticulo', 'btnDesactivar');
    }
}
