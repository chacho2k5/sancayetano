<?php 

namespace App\Http\Livewire\Cliente;

use Throwable;

use App\Models\Iva;
use App\Models\Cliente;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;

class ClienteIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Busqueda y orden y paginacion tabla
    public $search = '';
    public $paginado = '10';
    public $sort = 'razonsocial';
    public $direction = 'asc';

    // Modales
    public $modal_title;
    public $modal_action;
    public $modal_content;
    public $modal_width = 'md';

    public $registro_id;        // ID del registro seleccionado para borrar o lo que sea

    // Modelos
    public $ivas;

    // Datos para el alta
    public $razonsocial, $contacto, $cuit, $iva_id,$telefono1;
    public $telefono2, $correo, $calle_nombre, $calle_numero , $codigo_postal;
    public $fecha_alta, $observaciones;
    public $selectedIva;

     // Se escucha el evento 'render' y se ejecuta el metodo 'render'
    // protected $listeners = ['render', 'render'];
    // Cuando evento y metodo son iguales, se puede poner uno solo
    protected $listeners = ['render'];

    protected $rules = [
       'razonsocial' => 'required|max:100|min:3',
      //  'detalle' => 'required|max:100|min:2',
    ];

    protected $messages = [
        'razonsocial.required' => 'Debe ingresar una Razon Social',
        'razonsocial.min' =>  'la Razon Social debe tener entre 3 y 100 caracteres',
      //  'descripcion.max' => 'El Estado debe tener entre 3 y 10 caracteres',
      //  'detalle.min' => 'La descripción del Estado debe tener entre 3 y 10 caracteres',
      //  'detalle.min' => 'La descripción del Estado debe tener entre 3 y 10 caracteres',
        // 'invitation.email.unique.invitations' => 'The email has already been invited.',
        // 'invitation.email.unique.users' => 'An account with this email has already been registered.',
    ];

    public function mount() {
        $this->ivas= Iva::select('id','nombre')
                            ->orderBy('nombre', 'asc')
                            ->get();
    }

    public function render(): View
    {

        return view('livewire.cliente.cliente-index', [
            'registros' => Cliente::where('razonsocial', 'like', '%' . $this->search . '%')
                      ->orWhere('correo', 'like', '%' . $this->search . '%')
                      ->orderBy($this->sort, $this->direction)
                      ->paginate(10),$this->ivas
        ]);
    }

    public function createModal() {
        $this->modal_title = "NUEVO CLIENTE";
        $this->modal_width = 'lg';

        $this->modal_action = "create";
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function editModal($id, $value) {
        // Muestro el modal, uso el mismo para el Ver/editar.
        // Defino y el titulo y asigno los valores de los campos con las variables del reg. seleccionado.

            if ($value == 'edit') {
                $this->modal_title = "ACTUALIZAR CLIENTE";
            } else {
                $this->modal_title = "DATOS CLIENTE";
            }
            $this->modal_width = 'lg';
            $this->modal_action = $value;

            $reg = Cliente::findOrFail($id);
            $this->registro_id = $reg->id;
            $this->razonsocial = $reg->razonsocial;
            $this->contacto = $reg->contacto;
            $this->cuit = $reg->cuit;
            //$this->iva_id = $reg->iva_id;
            $this->telefono1 = $reg->telefono1;
            $this->telefono2 = $reg->telefono2;
            $this->correo = $reg->correo;
            $this->calle_nombre = $reg->calle_nombre;
            $this->calle_numero = $reg->calle_numero;
            $this->codigo_postal = $reg->codigo_postal;
            $this->fecha_alta = $reg->fecha_alta;
            $this->observaciones = $reg->observaciones;
            $this->selectedIva = $reg->iva_id;

            $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function grabar() {
        // Grabo las modificaciones y las altas

        $this->validate();

        Cliente::updateOrCreate(['id' => $this->registro_id],
        [
            'razonsocial'=> $this->razonsocial,
            'contacto' => $this->contacto,
            'cuit' => $this->cuit,
            'iva_id' => $this->iva_id,
            'telefono1' => $this->telefono1,
            'telefono2' => $this->telefono2,
            'correo' => $this->correo,
            'calle_nombre' => $this->calle_nombre,
            'calle_numero' => $this->calle_numero,
            'codigo_postal' => $this->codigo_postal,
            'fecha_alta' => $this->fecha_alta,
            'observaciones' => $this->observaciones,

        ]);

        $this->cancel();

        $this->dispatchBrowserEvent('close-modal');

    }

    public function deleteModal($id) {

        $this->registro_id = $id;

        $this->modal_title = "BORRAR CLIENTE";
        $this->modal_content = 'Desea borrar el registro seleccionado ?';
        $this->modal_width = 'md';

        $this->modal_action = "delete";
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete() {

        // Buscar registro y borrarlo

        Cliente::destroy($this->registro_id);

        $this->dispatchBrowserEvent('close-modal');

        // session()->flash('message', 'Registro borrado exitosamente '.$this->registro_id);

        $this->registro_id = null;

    }

    public function cancel() {
        $this->dispatchBrowserEvent('close-modal');
        // $this->reset;
    }

    public function order($sort) {

        if($this->sort == $sort) {
            if($this->direction == 'asc') {
                $this->direction = 'desc';
            } else {
                $this->direction = 'asc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

}
