<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
//use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;
//use App\Exports\UsersExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;



class UsuarioIndex extends Component
{

    use WithPagination; 
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $sort = 'id';
    public $direction = 'asc';
    public $readyToLoad = false;
  
  //  public $categorias, $categoria;
  //  public $selectedCategoria;
   // public $id;
    
    // Conjunto de datos
    // public Estado $registros;
    //public $registros;
  

    // Datos para el alta
    public $registro_id, $nombre;

    // Datos para la modificacion
    public $open_modal = false;

    public $readOnly = null;

    public $aux = 0;
    public $action;      // edit - show
    public $titulo_modal = "Crear nuevo Usuario";

    // Se escucha el evento 'render' y se ejecuta el metodo 'render'
    // protected $listeners = ['render', 'render'];
    // Cuando evento y metodo son iguales, se puede poner uno solo
    protected $listeners = ['render'];

    protected $rules = [
      //  'descripcion' => 'required|max:100|min:3',
        'nombre' => 'required'
        //'detalle' => 'required|max:100|min:2',
    ];

    protected $messages = [
        'nombre.required' => 'Debe ingresar un nombre de usuario',
     
    ];

    

    public function mount() {
    //    $this->categorias = Categoria::select('id','descripcion')
     //   ->orderBy('descripcion', 'asc')
   //     ->get();
      
    }

    public function render()
    {
        //:whith(relation:'categorias')-
       $registros = User::where('name', 'like', '%' . $this->search . '%')
               ->orderBy($this->sort, $this->direction)
               ->paginate(5);

       return view('livewire.usuario.usuario-index', ['registros' => $registros ]);


     }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'nombre' => 'required',
                       // 'detalle' => 'required|max:100|min:3',
        ]);
    }


    public function loadModelo() {
        $this->readyToLoad = true;
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

    public function edit_show($registro_id, $value) {
    // Muestro el modal, uso el mismo para el Ver/editar.
    // Defino y el titulo y asigno los valores de los campos con las variables del reg. seleccionado.

        if ($value == 'edit') {
            $this->titulo_modal = "Actualizar Usuarios";
        } else {
            $this->titulo_modal = "Usuario";
        }

        $reg = User::findOrFail($registro_id);
        $this->id = $reg->id;
        $this->nombre = $reg->name;
    //    $this->categoria_id = $reg->selectedCategoria;
           

        $this->action = $value;
        $this->open_modal = true;
    }

    public function create() {
    // Muestro el modal para el Alta
        $this->cancel();
        $this->action = 'create';
        $this->open_modal = true;
     //   $this->selectedCategoria = '';
    }

    public function grabar() {
    // Grabo las modificaciones y las altas

        $this->validate();

        User::updateOrCreate(['id' => $this->registro_id],
        [
        //    dd($this->categoria_id),

            'nombre' => $this->name,
         ]);

       
        $this->cancel();

        // El evento solo lo escucha el componente "show-posts"
    //     // $this->emitTo('estado.estado-index', 'render');

    //     // El evento "alert" lo escucha todo el mundo
    //     // $this->emit('alert','El Estado se creo correctamente');

    }

    public function delete($id) {

        User::destroy($id);
    }

    public function cancel()
    {
        $this->reset(['registro_id', 'name', 'open_modal', 'titulo_modal']);

    }


/*
    public function exportExcel(){
        // return Excel::download(new ClientesExport, 'clientes.xlsx');
         return (new UsersExport)->download('Users.xlsx');
         
     }
 
     public function exportPdf(){
         return (new UsersExport )->download('Users.pdf', \Maatwebsite\Excel\Excel::DOMPDF );
      
     }
 */

}

