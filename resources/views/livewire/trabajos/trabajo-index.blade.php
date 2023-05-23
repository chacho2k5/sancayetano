<div>
    <div x-data="{indexRow: @entangle('indexRow'), selected: null, selectedRow: @entangle('selectedRow'), trabajoId: @entangle('trabajo_id'), estadoId: @entangle('estado_id'), reclamo: @entangle('reclamo') }" class="px-0 mx-0 container-fluid">
        <div class="mb-1 row row-cols-auto justify-content-between">
            {{-- <div class="mt-2 mb-4 container-fluid"> --}}
            <div class="col d-flex">
                <h5>TRABAJOS</h5>
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
                {{-- <button wire:click="updateTrabajo('imprimir-ot')" class="btn btn-dark btn-sm ps-1" data-toggle="tooltip" title='Imprimir OT.'>
                    <i class="bi bi-credit-card-2-front text-outline-outline-success text-bold text-md-center pe-1 ps-1"></i>
                    Imprimir OT
                </button> --}}

                {{-- Export EXCEL --}}
                <button wire:click="exportExcel" class="btn btn-success btn-sm" data-toggle="tooltip" title='Exportar Trabajos a Excel'>
                    <i class='fas fa-file-excel'></i> 
                </button>
                {{-- Export PDF --}}
                <button wire:click="exportPdf" class="btn btn-danger btn-sm me-5" data-toggle="tooltip" title='Exportar Trabajos a Pdf'>
                    <i class='fas fa-file-pdf'></i>
                </button> 

                {{-- Cambiar Estado --}}
                <button wire:click="updateTrabajo('estado')" class="btn btn-info btn-sm" data-toggle="tooltip" title='Cambiar Estado del Trabajo.'>
                    <i class="bi bi-repeat text-outline-outline-success text-bold text-md-center"></i>
                    Cambiar Estado Trabajo
                </button>

                <button wire:click.prevent="updateTrabajo('reclamo')" class="text-white btn btn-warning btn-sm ps-1" data-toggle="tooltip" title='Agregar Reclamo.'>
                    <i class="bi bi-plus-circle pe-1 ps-1"></i>
                    Reclamo
                </button>
                {{-- Agregar PEDIDO --}}
                {{-- <button wire:click="updateTrabajo('create')" class="btn btn-info btn-sm" data-toggle="tooltip" title='Nuev Pedido.'>
                    <i class="bi bi-plus-circle text-outline-outline-success text-bold text-md-center"></i>
                </button> --}}
                {{-- Mostrar PEDIDO --}}
                <button wire:click="updateTrabajo('show')" class="btn btn-success btn-sm" data-toggle="tooltip" title='Mostrar datos del Trabajo.'>
                    <i class="bi bi-eye text-outline-success text-bold text-md-center"></i>
                </button>
                {{-- Editar PEDIDO --}}
                <button wire:click="updateTrabajo('update')" class="btn btn-primary btn-sm" data-toggle="tooltip" title='Editar Trabajo.'>
                    <i class="bi bi-pencil-fill text-outline-primary text-bold text-md-center"></i>
                </button>
                {{-- Eliminar PEDIDO --}}
                {{-- <button wire:click="updateTrabajo('delete')" class="btn btn-danger btn-sm" data-toggle="tooltip" title='Borrar Pedido'>
                    <i class="bi bi-trash text-outline-danger text-bold text-md-center"></i>
                </button> --}}
            </div>
        </div>            

            <div class="px-0 py-1 card-body">
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
                    <div class="justify-content-end pagination-sm">
                        {{ $registros->links() }}
                    </div>
                </div>
            </div>

        <div class="table-responsive" x-data="{indexRow: 0}">
            {{-- <table class="table table-hover table-bordered my-table"> --}}
                
            <table class="table table-hover table-bordered table-responsive-md text-nowrap my-table table-sticky">
                <thead class="align-middle">
                    <tr>
                        {{-- <th><i class="bi bi-printer" title="Imprimir Orden Trabajo"></i></th> --}}
                        <th>E</th>
                        <th class="cursor-pointer"
                                wire:click='order("fecha_pedido")'>
                                FECHA TRABAJO
                                @if ($sortField == 'fecha_pedido')
                                    @if ($sortOrden == 'asc')
                                        <i class="float-end bi bi-chevron-up"></i>
                                    @else
                                        <i class="float-end bi bi-chevron-down"></i>
                                    @endif
                                @else
                                    <i class="float-end bi bi-chevron-expand"></i>
                                @endif
                        </th>
                        <th class="cursor-pointer" wire:click='order("fecha_entrega")'>
                            FECHA ENTREGA
                            @if ($sortField == 'fecha_entrega')
                                @if ($sortOrden == 'asc')
                                    <i class="float-end bi bi-chevron-up"></i>
                                @else
                                    <i class="float-end bi bi-chevron-down"></i>
                                @endif
                            @else
                                <i class="float-end bi bi-chevron-expand"></i>
                            @endif
                        </th>
                        <th class="cursor-pointer" wire:click='order("razonsocial")'>
                            CLIENTE
                            @if ($sortField == 'razonsocial')
                                @if ($sortOrden == 'asc')
                                    <i class="float-end bi bi-chevron-up"></i>
                                @else
                                    <i class="float-end bi bi-chevron-down"></i>
                                @endif
                            @else
                                <i class="float-end bi bi-chevron-expand"></i>
                            @endif
                        </th>

                        <th>TRABAJO</th>
                        <th class="text-center">A-L-E</th>
                        <th class="text-center">CANT.</th>
                        <th class="text-center">PRECIO</th>
                        <th class="text-center">IVA</th>      {{-- Tratamiento --}}
                        <th class="text-center">TOTAL</th>      {{-- FUELLE --}}
                        <th class="text-center">BULTOS</th>
                        <th>OBSERVACIONES</th>
                </thead>
                <tbody class="my-body-table">
                    @foreach ( $registros as $reg)
                        <tr id={{ $reg->id }}
                            x-on:click="selected !== {{ $reg->id }} ? selected = {{ $reg->id }} : selected = null, selectedRow = selected, trabajoId = selected, estadoId = {{ $reg->estado_id }}, reclamo = {{ $reg->reclamo }}" 
                            :class="{'bg-success text-black':selected === {{ $reg->id }} , 'bg-danger ':{{ $reg->estado_id }} == 5, 'bg-secondary':{{ $reg->estado_id }} == 6, 'bg-warning':{{ $reg->reclamo }} && selected != {{ $reg->id }}}"
                            >
                            <td title="{{ $reg->estado_nombre }}">{{ substr($reg->estado_nombre,0,1) }}</td>
                            <td>{{ date('d/m/Y', strtotime($reg->fecha_pedido)) }}</td>
                            <td>{{ date('d/m/Y', strtotime($reg->fecha_entrega)) }}</td>
                            <td title="{{ $reg->razonsocial }}">{{ $reg->razonsocial }}</td>
                            <td>{{ $reg->trabajo_nombre }}</td> 
                            <td>{{ $reg->ancho . ' - ' . $reg->largo . ' - ' . $reg->espesor }}</td>

                            {{-- <td :class="{'bg-primary':{{ $reg->estado_id }} == 4, 'bg-warning':{{ $reg->reclamo }} }">
                                {{ ($reg->estado_id==2) ? '*' : ' ' }}
                            </td> --}}

                            <td :class="{'table-secondary': {{ ($reg->cantidad_bolsas_trabajo == 0) }}}">{{ $reg->cantidad_bolsas }}</td>
                            <td>{{ $reg->precio_unitario }}</td>
                            <td>{{ $reg->precio_iva }}</td>
                            <td>{{ $reg->precio_total }}</td>
                            <td>{{ $reg->bultos }}</td>
                            <td title="{{ $reg->observaciones }}">{{ $reg->observaciones }}</td>

                            {{-- <td :class="{'table-secondary': {{ ($reg->precio_unitario == 0) }}}">{{ $reg->precio_unitario }}</td>
                            <td :class="{'table-secondary': {{ ($reg->precio_iva == 0) }}}">{{ $reg->precio_iva }}</td>
                            <td :class="{'table-secondary': {{ ($reg->precio_total == 0) }}}">{{ $reg->precio_total }}</td>
                            <td :class="{'table-secondary': {{ ($reg->cantidad_bultos == 0) }}}">{{ $reg->bultos }}</td> --}}

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
        @include('livewire.trabajos.reclamo-create')
        @include('livewire.trabajos.cambiar-estado')
        @include('livewire.trabajos.trabajo-update')

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
        window.addEventListener('show-trabajo-modal', event =>{
                $('#trabajoModal').modal('show');
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
            $('#trabajoModal').modal('hide');
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

