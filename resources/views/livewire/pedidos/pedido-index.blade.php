<div> 
    <div x-data="{indexRow: @entangle('indexRow'), selected: null, selectedRow: @entangle('selectedRow'), pedidoId: @entangle('pedido_id'), estadoId: @entangle('estado_id'), reclamo: @entangle('reclamo') }" class="px-0 mx-0 container-fluid">
        <div class="mb-0 row row-cols-auto justify-content-between">
            {{-- <div class="mt-2 mb-4 container-fluid"> --}}
            <div class="col d-flex">
                <h5>PEDIDOS</h5>
            </div>
            @if (session('status'))
                <div class="col-md-auto me-3">
                    <div class="py-0 m-0 ps-0 pe-3 alert alert-{{ $color_status }}" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                        <ul>
                            <li><small>{{ session('status') }}</small></li>
                        </ul>
                    </div>
                </div>
            @endif
            <div class="col"> 
                {{-- Imprimir OT --}}
                <a  class="btn btn-dark btn-sm ps-1 me-4" :class="{'disabled':!selectedRow}"
                href="{{ route('ots.report', $pedido_id) }}" target="_blank"><i class="bi bi-credit-card-2-front text-outline-outline-success text-bold text-md-center pe-1 ps-1"></i>Imprimir OT</a>

                {{-- Export EXCEL --}}
                {{-- <button wire:click="exportExcel" :class="{'disabled':!selectedRow}" class="btn btn-success btn-sm" data-toggle="tooltip" title='Exportar Pedidos a Excel'>
                    <i class='fas fa-file-excel'></i> 
                </button> --}}
                {{-- Export PDF --}}
                {{-- <button wire:click="exportPdf" :class="{'disabled':!selectedRow}" class="btn btn-danger btn-sm me-5" data-toggle="tooltip" title='Exportar Pedidos a Pdf'>
                    <i class='fas fa-file-pdf'></i>
                </button>  --}}

                {{-- Cambiar Estado --}}
                <button wire:click="editarOt('estado')" :class="{'disabled':!selectedRow}" class="btn btn-info btn-sm" data-toggle="tooltip" title='Cambiar Estado del Pedido.'>
                    <i class="bi bi-repeat text-outline-outline-success text-bold text-md-center"></i>
                    Cambiar Estado Pedido
                </button>
                {{-- RECLAMO --}}
                <button wire:click.prevent="editarOt('reclamo')" :class="{'disabled':!selectedRow}" class="text-white btn btn-warning btn-sm ps-1 me-4" data-toggle="tooltip" title='Agregar Reclamo.'>
                    <i class="bi bi-plus-circle pe-1 ps-1"></i>
                    Reclamo
                </button>
                {{-- Agregar PEDIDO --}}
                <button wire:click="editarOt('create')" class="btn btn-info btn-sm" data-toggle="tooltip" title='Nuev Pedido.'>
                    <i class="bi bi-plus-circle text-outline-outline-success text-bold text-md-center"></i>
                    Nuevo Pedido
                </button>
                {{-- Mostrar PEDIDO --}}
                <button wire:click="editarOt('show')" :class="{'disabled':!selectedRow}" class="btn btn-success btn-sm" data-toggle="tooltip" title='Mostrar datos Pedido.'>
                    <i class="bi bi-eye text-outline-success text-bold text-md-center"></i>
                </button>
                {{-- Editar PEDIDO --}}
                <button wire:click="editarOt('edit')" :class="{'disabled':!selectedRow}" class="btn btn-primary btn-sm" data-toggle="tooltip" title='Editar Pedido.'>
                    <i class="bi bi-pencil-fill text-outline-primary text-bold text-md-center"></i>
                </button>
                {{-- Eliminar PEDIDO --}}
                <button wire:click="editarOt('delete')" :class="{'disabled':!selectedRow}" class="btn btn-danger btn-sm" data-toggle="tooltip" title='Borrar Pedido'>
                    <i class="bi bi-trash text-outline-danger text-bold text-md-center"></i>
                </button>
            </div>
        </div>            
        <div class="row row-cols-auto justify-content-between">
            <div class="col d-flex">
                <div class="py-1 bd-highlight">
                    <select wire:model="selectedMes" class="form-select form-select-sm me-1 m-0 @error('selectedMes') is-invalid @enderror" title="Seleccione un mes.">
                        <option value="0">Seleccione un mes</option>
                        @foreach($meses as $mes)
                            <option value="{{ $mes->id }}">
                                {{ $mes->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>    
                <div class="py-1 bd-highlight ps-2">
                    <select wire:model="selectedEstado" class="form-select form-select-sm @error('selectedEstado') is-invalid @enderror" title="Seleccione un estado.">
                        <option value="0">Seleccione un Estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>    
                <div class="p-1 bd-highlight ps-2">
                    <input type="search" wire:model="search" class="flex-1 form-control form-control-sm me-3" placeholder="Ingrese busqueda...">
                </div>
            </div>
            @if (session('status'))
                <div class="col-md-auto me-3">
                    <div class="py-0 m-0 ps-0 pe-3 alert alert-{{ $color_status }}" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                        <ul>
                            <li><small>{{ session('status') }}</small></li>
                        </ul>
                    </div>
                </div>
            @endif
            <div class="col d-flex">
                <div class="pt-2">
                    {{ $registros->links() }}
                </div>
                <div class="p-1 bd-highlight">
                    <select wire:model="selectedPerPage" class="form-select form-select-sm me-1 m-0 @error('selectedPerPage') is-invalid @enderror" title="Seleccione cantidad de páginas.">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>    
            </div>
        </div> 
        {{-- <div class="row row-cols-auto justify-content-between ps-3 p-0 m-0">
            <div class="col d-flex p-0 m-0">
                <div class="py-1 bd-highlight">
                    <select wire:model="selectedMes" class="form-select form-select-sm me-1 m-0 @error('selectedMes') is-invalid @enderror" title="Seleccione un mes.">
                        <option value="0">Seleccione un mes</option>
                        @foreach($meses as $mes)
                            <option value="{{ $mes->id }}">
                                {{ $mes->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>    
                <div class="py-1 bd-highlight ps-2">
                    <select wire:model="selectedEstado" class="form-select form-select-sm @error('selectedEstado') is-invalid @enderror" title="Seleccione un estado.">
                        <option value="0">Seleccione un Estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>    
                <div class="p-1 bd-highlight ps-2">
                    <input type="search" wire:model="search" class="flex-1 form-control form-control-sm me-3" placeholder="Ingrese busqueda...">
                </div>
            </div>
            <div class="col pagination-sm p-0 m-0">
                {{ $registros->links() }}
            </div>
        </div> --}}

        {{-- FILTRO - BUSQUEDA --}}
        {{-- <div class="px-0 py-1 card-body">
            <div class="flex-row d-flex bd-highlight">
                <div class="py-1 bd-highlight">
                    <select wire:model="selectedMes" class="form-select form-select-sm me-1 m-0 @error('selectedMes') is-invalid @enderror" title="Seleccione un mes.">
                        <option value="0">Seleccione un mes</option>
                        @foreach($meses as $mes)
                            <option value="{{ $mes->id }}">
                                {{ $mes->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>    
                <div class="py-1 bd-highlight ps-2">
                    <select wire:model="selectedEstado" class="form-select form-select-sm @error('selectedEstado') is-invalid @enderror" title="Seleccione un estado.">
                        <option value="0">Seleccione un Estado</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>    
                <div class="p-1 bd-highlight ps-2">
                    <input type="search" wire:model="search" class="flex-1 form-control form-control-sm me-3" placeholder="Ingrese busqueda...">
                </div>
                <div class="flex-column-reverse pagination-sm">
                    {{ $registros->links() }}
                </div>
            </div>
        </div> --}}
        <div class="container-fluid table-responsive" x-data="{indexRow: 0}">
            {{-- <table class="table table-hover table-bordered my-table"> --}}
            {{-- <table class="table table-hover table-bordered table-responsive-md text-nowrap my-table table-sticky"> --}}
            <table class="table table-hover text-nowrap">
                {{-- <thead class="align-middle"> --}}
                <thead style="background-color: #4082B0; color: #dee2e6;">
                    <tr>
                        {{-- <th><i class="bi bi-printer" title="Imprimir Orden Trabajo"></i></th> --}}
                        <th>*</th>
                        <th>E</th>
                        <th class="cursor-pointer"
                                wire:click='order("numero_ot")'>
                                Nro. OT
                                @if ($sortField == 'numero_ot')
                                    @if ($sortOrden == 'asc')
                                        {{-- <i class="bi bi-chevron-up"></i> --}}
                                        <i class="bi bi-caret-up-fill"></i>
                                    @else
                                        {{-- <i class="bi bi-chevron-down"></i> --}}
                                        <i class="bi bi-caret-down-fill"></i>
                                    @endif
                                @else
                                    <i class="bi bi-chevron-expand"></i>
                                @endif
                        </th>
                        <th class="cursor-pointer"
                                wire:click='order("fecha_pedido")'>
                                FECHA PEDIDO
                                @if ($sortField == 'fecha_pedido')
                                    @if ($sortOrden == 'asc')
                                        {{-- <i class="bi bi-chevron-up"></i> --}}
                                        <i class="bi bi-caret-up-fill"></i>
                                    @else
                                        {{-- <i class="bi bi-chevron-down"></i> --}}
                                        <i class="bi bi-caret-down-fill"></i>
                                    @endif
                                @else
                                    <i class="bi bi-chevron-expand"></i>
                                @endif
                        </th>
                        <th class="cursor-pointer" wire:click='order("fecha_entrega")'>
                            FECHA ENTREGA
                            @if ($sortField == 'fecha_entrega')
                                @if ($sortOrden == 'asc')
                                    <i class="bi bi-caret-up-fill"></i>
                                @else
                                <i class="bi bi-caret-down-fill"></i>
                                @endif
                            @else
                                <i class="bi-chevron-expand"></i>
                            @endif
                        </th>
                        <th class="cursor-pointer" wire:click='order("razonsocial")'>
                            CLIENTE
                            @if ($sortField == 'razonsocial')
                                @if ($sortOrden == 'asc')
                                <i class="bi bi-caret-up-fill"></i>
                                @else
                                <i class="bi bi-caret-down-fill"></i>
                                @endif
                            @else
                                <i class="bi bi-chevron-expand"></i>
                            @endif
                        </th>
                        <th>TRABAJO</th>
                        <th class="text-center">A-L-E</th>
                        <th class="text-center">CANT.</th>
                        <th class="text-center">COLOR</th>
                        <th class="text-center">T</th>      {{-- Tratamiento --}}
                        <th class="text-center">F</th>      {{-- FUELLE --}}
                        <th class="text-center">CORTE</th>
                        <th class="text-center">P.UNIT</th>
                        <th class="">OBSERVACIONES</th>
                    </tr> 
                </thead>
                {{-- <tbody class="my-body-table"> --}}
                <tbody>
                    @foreach ( $registros as $reg)
                        <tr id={{ $reg->id }}
                            x-on:click="selected !== {{ $reg->id }} ? selected = {{ $reg->id }} : selected = null, selectedRow = selected, pedidoId = selected, estadoId = {{ $reg->estado_id }}, reclamo = {{ $reg->reclamo }}" 
                            :class="{'bg-success text-black':selected === {{ $reg->id }} , 'bg-primary ':{{ $reg->estado_id }} == 4, 'bg-warning':{{ $reg->reclamo }} && selected != {{ $reg->id }}}"
                            >
                            <td :class="{'bg-primary':{{ $reg->estado_id }} == 4, 'bg-warning':{{ $reg->reclamo }} }">
                                {{ ($reg->estado_id==2) ? '*' : '-' }}
                            </td>
                            <td title="{{ $reg->estado_nombre }}">{{ substr($reg->estado_nombre,0,1) }}</td>
                            <td>{{ $reg->numero_ot }}</td>
                            <td>{{ date('d/m/Y', strtotime($reg->fecha_pedido)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($reg->fecha_entrega)) }}</td>
                            <td title="{{ $reg->razonsocial }}">{{ $reg->razonsocial }}</td>
                            <td title="{{ $reg->trabajo_nombre }}">{{ substr($reg->trabajo_nombre,0,30) }}</td>
                            <td class="text-center">{{ $reg->ancho . '-' . $reg->largo . '-' . $reg->espesor }}</td>
                            <td>{{ $reg->cantidad_bolsas }}</td>
                            <td>{{ $reg->color->nombre }}</td>
                            <td>{{ $reg->tratado->nombre }}</td>
                            <td>{{ $reg->bolsa_largo_fuelle }}</td>
                            <td>{{ $reg->corte->nombre }}</td>
                            <td>{{ $reg->precio_unitario }}</td>
                            <td title="{{ $reg->observaciones }}">{{ substr($reg->observaciones,0,50) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="pagination justify-content-end">
                {{ $registros->links() }}
            </div> --}}
        </div>
        {{-- <div class="py-0 pagination justify-content-end pagination-sm">
            {{ $registros->links() }}
        </div> --}}
        @include('livewire.pedidos.reclamo-create') 
        @include('livewire.pedidos.cambiar-estado')

        <x-zmodal id="imprimirModal" maxWidth="md">
            <x-slot name="title">
                <h4>{{ $modal_title }}</h4>
            </x-slot>
            <x-slot name="content">
                <br>
                <h5>{{ $modal_content }}</h5>
                <br>
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-sm btn-secondary" wire:click="cancelModal" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle pe-1"></i>
                    Cancelar
                </button>
                <button class="btn btn-sm btn-danger" wire:click="imprimirOt">
                    <i class="bi bi-printer text-outline-outline-success text-bold text-md-center pe-1 ps-1"></i>
                    Imprimir
                </button>
            </x-slot>
        </x-zmodal>

        <x-zmodal id="alertModal" maxWidth="md">
            <x-slot name="title">
                <h5>{{ $modal_title }}</h5>
            </x-slot>
            <x-slot name="content">
                <h5>{{ $modal_content }}</h5>
            </x-slot>
            <x-slot name="footer">
                <button class="btn btn-md btn-danger" wire:click="cancelModal" data-dismiss="modal" aria-label="Close">Aceptar</button>
            </x-slot>
        </x-zmodal>
    
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('show-imprimir-modal', event =>{
                $('#imprimirModal').modal('show');
        });

        window.addEventListener('show-estado-modal', event =>{
                $('#estadoModal').modal('show');
        });

        window.addEventListener('show-reclamo-modal', event =>{
                $('#reclamoModal').modal('show');
        });

        window.addEventListener('show-delete-modal', event =>{
                $('#deleteModal').modal('show');
        });

        window.addEventListener('show-alert-modal', event =>{
                $('#alertModal').modal('show');
        });

        window.addEventListener('close-modal', event =>{
            $('#deleteModal').modal('hide');
            $('#alertModal').modal('hide');
            $('#reclamoModal').modal('hide');
            $('#estadoModal').modal('hide');
            $('#imprimirModal').modal('hide');
        });
        
        window.addEventListener('borrar-reclamo', event => {
                result = window.confirm(event.detail.msg);
                if (result) {
                    window.Livewire.emit('borrarReclamo');
                }
        });

        document.addEventListener("livewire:load", function () {
            Livewire.on('gotoPage', function (page) {
                Livewire.emit('gotoPage', page);
            });

            @if ($currentPage > 1)
                Livewire.emit('gotoPage', {{ $currentPage }});
            @endif
        });
    </script>
@endpush

<script>
    function data(){
        return {
            open:null,
            selRow(){
                alert('hola fila');
            },
            start(){
                this.open = false
            },
            isOpen(){
                this.open = !this.open
            },
            close(){
                this.open = false
            }
        }
    }
</script>

