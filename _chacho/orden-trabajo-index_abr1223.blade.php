<div>
    <div x-data="{selectedRow: @entangle('selectedRow'), auxId: @entangle('registro_id'), auxEstado: @entangle('estado_id'), auxReclamo: @entangle('reclamo') }" class="px-0 mx-0 container-fluid">
        <div class="mb-1 row row-cols-auto justify-content-between">
            {{-- <div class="mt-2 mb-4 container-fluid"> --}}
            <div class="col d-flex">
                <h5>ORDEN TRABAJO</h5>
            </div>
            <div class="col">
                {{-- Export EXCEL --}}
                <button wire:click="exportExcel" class="btn btn-success btn-sm" data-toggle="tooltip" title='Exportar a Excel'>
                    <i class='fas fa-file-excel'></i> 
                </button>
                {{-- Export PDF --}}
                <button wire:click="exportPdf" class="btn btn-danger btn-sm me-5" data-toggle="tooltip" title='Exportar a Pdf'>
                    <i class='fas fa-file-pdf'></i>
                </button> 

                <button wire:click.prevent="editarOt('reclamo')" class="text-white btn btn-warning btn-sm ps-1" data-toggle="tooltip" title='Agregar Reclamo.'>
                    <i class="bi bi-plus-circle pe-1 ps-1"></i>
                    Reclamo
                </button>
                {{-- Agregar OT --}}
                <button wire:click="editarOt('create')" class="btn btn-info btn-sm" data-toggle="tooltip" title='Nueva OT.'>
                    <i class="bi bi-plus-circle text-outline-outline-success text-bold text-md-center"></i>
                </button>
                {{-- Mostrar OT --}}
                <button wire:click="editarOt('show')" class="btn btn-success btn-sm" data-toggle="tooltip" title='Mostrar datos.'>
                    <i class="bi bi-eye text-outline-success text-bold text-md-center"></i>
                </button>
                {{-- Editar OT --}}
                <button wire:click="editarOt('edit')" class="btn btn-primary btn-sm" data-toggle="tooltip" title='Editar OT.'>
                    <i class="bi bi-pencil-fill text-outline-primary text-bold text-md-center"></i>
                </button>
                {{-- Eliminar OT --}}
                <button wire:click="editarOt('delete')" class="btn btn-danger btn-sm" data-toggle="tooltip" title='Borrar OT'>
                    <i class="bi bi-trash text-outline-danger text-bold text-md-center"></i>
                </button>
            </div>
        </div>            

        <div class="card">
            <div class="card-header ps-2">
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
                    {{-- <div class="p-1 ps-2 pe-0 bd-highlight">
                        <button wire:click="exportExcel" class="btn btn-success me-1 btn-sm" data-toggle="tooltip" title='Exportar a Excel'>
                            <i class='fas fa-file-excel'></i> 
                        </button>
                    </div>
                    <div class="p-1 px-0 bd-highlight">
                        <button wire:click="exportPdf" class="btn btn-danger btn-sm" data-toggle="tooltip" title='Exportar a Pdf'>
                            <i class='fas fa-file-pdf'></i>
                        </button> 
                    </div> --}}
                </div>
            </div>
            <div class="px-0 py-1 card-body">
                <div class="table-scroll">
                    <table class="table table-hover table-bordered table-responsive-md text-nowrap my-table table-sticky">
                        <thead class="align-middle">
                        <tr>
                            {{-- <th>-</th> --}}
                            <th>*</th>
                            <th>E</th>
                            <th class="cursor-pointer"
                                    wire:click='order("fecha_pedido")'>
                                    FECHA PEDIDO
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
                            <th style="width: 45rem" class="cursor-pointer" wire:click='order("fecha_entrega")'>
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
                            <th style="width: 80rem" class="cursor-pointer" wire:click='order("razonsocial")'>
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
                            <th class="text-center">COLOR</th>
                            <th class="text-center">T</th>      {{-- Tratamiento --}}
                            <th class="text-center">F</th>      {{-- FUELLE --}}
                            <th class="text-center">Corte</th>
                            <th class="overflow-ellipsis">OBSERVACIONES <i class="bi bi-telephone"></i></th>
                        </tr> 
                        </thead>
                        <tbody class="my-body-table">
                            @foreach ( $registros as $reg)
                            <tr id={{ $reg->id }} 
                                    x-on:click="auxId=$el.id, auxEstado={{ $reg->estado_id }}, auxReclamo={{ $reg->reclamo }}" 
                                    x-bind:class="{'bg-success text-white':$el.id == auxId, 'bg-primary text-white':{{ $reg->estado_id }} == 4, 'bg-warning':{{ $reg->reclamo }}}">
                                {{-- <th><input class="form-check-input" type="checkbox"></th>
                                <td><input class="form-check-input" type="radio"></td> --}}
                                <td>
                                    {{ ($reg->estado_id==2) ? '*' : ' ' }}
                                </td>
                                <td>{{ substr($reg->estado_nombre,0,1) }}</td>
                                <td>{{ $reg->fecha_pedido }}</td>
                                <td>{{ $reg->fecha_entrega }}</td>
                                <td title="{{ $reg->razonsocial }}">{{ $reg->razonsocial }}</td>
                                <td>{{ $reg->trabajo_nombre }}</td>
                                <td>{{ $reg->ancho . ' - ' . $reg->largo . ' - ' . $reg->espesor }}</td>
                                <td>{{ $reg->cantidad_bolsas }}</td>
                                <td>{{ $reg->color->nombre }}</td>
                                <td>{{ $reg->tratado->nombre }}</td>
                                <td>{{ $reg->bolsa_largo_fuelle }}</td>
                                <td>{{ $reg->corte->nombre }}</td>
                                <td title="{{ $reg->observaciones }}">{{ $reg->observaciones }}</td>

                                {{-- <td class="text-center">
                                    <button wire:click.prevent="editModal({{ $reg->id }}, 'show')" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title='Mostrar datos.'>
                                        <i class="bi bi-eye text-outline-success text-bold text-sm-center"></i>
                                    </button>
                                    <button wire:click="editModal({{ $reg->id }}, 'edit')" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" title='Actualizar datos.'>
                                        <i class="bi bi-pencil-fill text-outline-primary text-bold text-sm-center"></i>
                                    </button>
                                    <button wire:click="deleteModal({{ $reg->id }})" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title='Borrar'>
                                        <i class="bi bi-trash text-outline-danger text-bold text-sm-center"></i>
                                    </button>
                                </td> --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="py-1 card-footer">
                <div class="py-0 pagination justify-content-end pagination-sm">
                    {{ $registros->links() }}
                </div>
            </div>
        </div>
        @include('livewire.orden-trabajo.reclamo-create')
    </div>
</div>

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

@push('scripts')
    <script>
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
        });
    </script>
@endpush
