<div> 
    <div class="container-fluid">
        <div x-data="{ open:false, auxId: @entangle('selectedArticulo') }" @keydown.enter.prevent="$focus.next()">
            <form wire:submit.prevent="grabarOT" autocomplete="off" class="needs-validation">
                @csrf
                <div class="card">
                    <div class="px-2 mx-auto align-items-center card-header row col-md-12">
                        <div class="col">
                            <h5 class="m-0">
                                {{ $this->title }}
                            </h5>
                        </div>
                        <div class="col col-md-auto">
                            @if ($action == 'show')
                                <button wire:click.prevent='cancelarOT' class="btn btn-success btn-sm ps-1" tabindex="0">
                                    <i class="bi bi-arrow-left-circle-fill pe-1"></i>
                                    Volver
                                </button>
                            @else
                                <button wire:click.prevent='cancelarOT' class="btn btn-secondary btn-sm ps-1" tabindex="0">
                                    <i class="bi bi-arrow-left-circle-fill pe-1"></i>
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-danger btn-sm ps-1 ms-2" tabindex="0">
                                    <i class="bi bi-check-circle-fill pe-1"></i>
                                    Grabar
                                </button>
                            @endif
                        </div>
                    </div>
    
                    @if ($action == 'show')<fieldset disabled='disabled'>@endif
    
                    <div class="card-body">
                        <div class="mb-2 row">
                            <div class="col-md-2">
                                <x-zform-input type="date" wire:model.lazy='fecha_pedido' name="fecha_pedido" label="Fecha Pedido" placeholder='label' title="Debe ingresar la 'Fecha del Pedido'." autofocus/>
                            </div>
                            <div class="col-md-2">
                                <x-zform-input type="date" wire:model.lazy='fecha_entrega' name="fecha_entrega" label="Fecha Entrega" placeholder='label' />
                            </div>
                            <div class="col-md-4">
                                <div class="mb-0 form-group">
                                    <label for="" class="mb-1 form-label form-label-sm">Cliente</label>
                                    <div class="row gx-2">
                                        <div class="col-8">
                                            <div class="input-group">
                                                <select wire:model="selectedCliente" class="form-select form-select-sm mb-1 @error('selectedCliente') is-invalid @enderror" title="Debe seleccionar un cliente.">
                                                    <option value="0">Seleccione un cliente</option>
                                                    @foreach($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">
                                                            {{ $cliente->razonsocial }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button wire:click.prevent="clienteModal()" class="btn btn-info btn-sm mb-1" data-toggle="tooltip" title='Mostrar trabajos.' 
                                                    {{-- style="--bs-btn-padding-y: 0rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: 1rem; --bs-btn-margin-y: 10rem; --bs-btn-height: 10rem;" --}}
                                                    >
                                                    <i class="bi bi-plus-lg text-bold text-md-center"></i>
                                                </button>
                                                @error('selectedCliente')
                                                    <span class="invalid-feedback" role="alert">
                                                        <span class="text-danger">Debe seleccionar un Cliente</span>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            @if ($trabajo_cantidad_activos)
                                                <button wire:click.prevent="trabajosModal({{ $selectedCliente }}, true)" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title='Trabajos activos.'>
                                                    <i class="bi bi-window"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-1">
                                            @if ($trabajo_cantidad_desactivos)
                                                <button wire:click.prevent="trabajosModal({{ $selectedCliente }}, false)" class="btn btn-outline-secondary btn-sm mx-0" data-toggle="tooltip" title='Trabajos desactivados.'>
                                                    <i class="bi bi-window-x"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="col-2">
                                            @if ($cantReclamosCliente > 0)
                                                <button wire:click.prevent="reclamosModal({{ $selectedCliente }})" class="btn btn-outline-warning btn-sm mx-0" data-toggle="tooltip" title='Reclamos'>
                                                    Reclamos
                                                </button>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2 offset-md-2">
                                <x-zform-input wire:model.lazy='numero_ot' name="numero_ot" label="Nro. Orden Trabajo" placeholder='label' title="Nro. de la 'Orden de Trabajo'." disabled />
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="form-group col-md-2">
                                <x-zform-input type="number" wire:model='cantidad_bolsas' name="cantidad_bolsas" label="Cant. Bolsas" placeholder='label' />
                            </div>
                            
                            {{-- <div class="form-group col-md-2">
                                <label for="cantidad_bolsas" class="mb-1 text-sm form-label form-label-sm">Cant. Bolsas</label>
                                <input type="text" wire:model='cantidad_bolsas' id="cantidad_bolsas" name="cantidad_bolsas"
                                    class="@error('cantidad_bolsas') is-invalid @enderror form-control form-control-sm">
                                @error('cantidad_bolsas')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="form-group col-md-2">
                                <x-zform-input wire:model='metros' name="metros" label="Metros" placeholder='label' disabled />
                            </div>
                            <div class="form-group col-md-2">
                                <x-zform-input wire:model='peso' name="peso" label="Peso" placeholder='label' disabled/>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="form-group col-md-4">
                                <x-zform-input type="text" wire:model.lazy='trabajo_nombre' name="trabajo_nombre" label="Nombre Trabajo" placeholder='label' title="Debe ingresar el 'Nombre del Trabajo'." />

                                {{-- <label for="trabajo_nombre" class="mb-1 text-sm form-label form-label-sm">Nombre Trabajo</label>
                                <input type="text" wire:model='trabajo_nombre' id="trabajo_nombre" name="trabajo_nombre"
                                    class="@error('trabajo_nombre') is-invalid @enderror form-control form-control-sm">
                                @error('trabajo_nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror --}}

                            </div>
                            <div class="form-group col-md-2">
                                <x-zform-input type="number" wire:model.lazy='ancho' name="ancho" label="Ancho" placeholder='label' />
                            </div>
                            <div class="form-group col-md-2">
                                <x-zform-input type="number" wire:model.lazy='largo' name="largo" label="Largo" placeholder='label' />
                            </div>
                            <div class="form-group col-md-2">
                                <x-zform-input type="number" wire:model.lazy='espesor' name="espesor" label="Espesor" placeholder='label' />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Tipo</label>
                                <select wire:model="selectedDensidad" class="form-select form-select-sm @error('selectedDensidad') is-invalid @enderror" title="Debe seleccionar un tipo.">
                                    <option value="0">Seleccione el tipo</option>
                                    @foreach($densidades as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->densidad}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedDensidad')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Material</label>
                                <select wire:model="selectedMaterial" class="form-select form-select-sm @error('selectedMaterial') is-invalid @enderror" title="Debe seleccionar un material.">
                                    <option value="0">Seleccione el material</option>
                                    @foreach($materiales as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedMaterial')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Color</label>
                                <div class="input-group">
                                    <select wire:model="selectedColor" class="form-select form-select-sm @error('selectedColor') is-invalid @enderror" title="Debe seleccionar un color.">
                                        <option value="0">Seleccione un color</option>
                                        @foreach($colores as $reg)
                                            <option value="{{ $reg->id }}">
                                                {{ $reg->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button wire:click.prevent="colorModal()" class="btn btn-info btn-sm" data-toggle="tooltip" title='Mostrar colores.'>
                                        <i class="bi bi-plus-lg text-bold text-md-center"></i>
                                    </button>
                                    @error('selectedColor')
                                        <span class="invalid-feedback" role="alert">
                                            <span class="text-danger">{{ $message }}</span>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <fieldset class="border rounded-2 px-2 pb-2 mb-3">
                            <legend class="float-none w-auto px-2" style="font-size: .75rem">COLORES</legend>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <select wire:model="selectedColor1" class="form-select form-select-sm @error('selectedColor1') is-invalid @enderror" title="Debe seleccionar un color.">
                                    <option value="0">Seleccione un color</option>
                                    @foreach($colores as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedColor1')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <select wire:model="selectedColor2" class="form-select form-select-sm @error('selectedColor2') is-invalid @enderror" title="Debe seleccionar un color.">
                                    <option value="0">Seleccione un color</option>
                                    @foreach($colores as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedColor2')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <select wire:model="selectedColor3" class="form-select form-select-sm @error('selectedColor3') is-invalid @enderror" title="Debe seleccionar un color.">
                                    <option value="0">Seleccione un color</option>
                                    @foreach($colores as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedColor3')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <select wire:model="selectedColor4" class="form-select form-select-sm @error('selectedColor4') is-invalid @enderror" title="Debe seleccionar un color.">
                                    <option value="0">Seleccione un color</option>
                                    @foreach($colores as $reg4)
                                        <option value="{{ $reg4->id }}">
                                            {{ $reg4->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedColor4')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        </fieldset>
                        <div class="mb-2 row gx-3">
                            <div class="form-group col-md-2">
                                <label for="" class="col-form-label-sm">Tipo Bolsa</label>
                                <select wire:model="selectedBolsa" class="form-select form-select-sm @error('selectedBolsa') is-invalid @enderror" title="Debe seleccionar un tipo de bolsa.">                                
                                    <option value="0">Seleccione Tipo de Bolsa</option>
                                    @foreach($bolsas as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedBolsa')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            
                            @if ($bolsa_fuelle == true)
                                <div class="mt-1 col-md-2 ">
                                    <x-zform-input type="number" wire:model.lazy='bolsa_largo_fuelle' name="bolsa_largo_fuelle" label="Largo fuelle" placeholder='label' />
                                </div>
                            @endif

                            <div class="form-group col-md-2">
                                <label for="" class="col-form-label-sm">Tratado</label>
                                <select wire:model="selectedTratado" class="form-select form-select-sm @error('selectedTratado') is-invalid @enderror" title="Debe seleccionar un tratado.">
                                    <option value="0">Seleccione un tratado</option>
                                    @foreach($tratados as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedTratado')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-2">
                                <label for="" class="col-form-label-sm">Corte</label>
                                <select wire:model="selectedCorte" class="form-select form-select-sm @error('selectedCorte') is-invalid @enderror" title="Debe seleccionar un tipo de corte.">
                                    <option value="0">Tipo de corte</option>
                                    @foreach($cortes as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedCorte')
                                    <span class="invalid-feedback" role="alert">
                                        <span class="text-danger">{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mt-2">
                                <x-zform-input type="number" wire:model.lazy='precio_unitario' name="precio_unitario" label="Precio Unitario ($)" placeholder='label' />
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <x-zform-area wire:model.lazy='observaciones' name="observaciones" label="Observaciones" placeholder='label' />
                        </div>
                        <div class="form-group row mb-2">
                            <x-zform-area wire:model.lazy='observaciones_extrusion' name="observaciones_extrusion" label="Observaciones Extrusión" placeholder='label' />
                        </div>
                        <div class="form-group row mb-2">
                            <x-zform-area wire:model.lazy='observaciones_impresion' name="observaciones_impresion" label="Observaciones Impresión" placeholder='label' />
                        </div>
                        <div class="form-group row">
                            <x-zform-area wire:model.lazy='observaciones_corte' name="observaciones_corte" label="Observaciones Corte" placeholder='label' />
                        </div>

                        {{-- <div class="card-footer"></div> --}}
                </div>      {{-- End Card --}}
                @if ($action == 'show')</fieldset>@endif
            </form>
        </div>
    </div>
    @include('livewire.pedidos.articulos-show')
    @include('livewire.pedidos.cliente-create')
    @include('livewire.pedidos.color-create')
    @include('livewire.pedidos.reclamos-show')

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

@push('scripts')
    <script>
        window.addEventListener('show-reclamos-modal', event =>{
                $('#reclamosModal').modal('show');
        });

        window.addEventListener('show-color-modal', event =>{
                $('#colorModal').modal('show');
        });

        window.addEventListener('show-cliente-modal', event =>{
                $('#clienteModal').modal('show');
        });

        window.addEventListener('show-alert-modal', event =>{
                $('#alertModal').modal('show');
        });

        window.addEventListener('show-articulos-modal', event =>{
            $('#articulosModal').modal('show');
        });

        window.addEventListener('close-modal', event =>{
            $('#articulosModal').modal('hide');
            // $('#deleteModal').modal('hide');
            $('#alertModal').modal('hide');
            // $('#reclamoModal').modal('hide');
            // $('#estadoModal').modal('hide');
            // $('#imprimirModal').modal('hide');
            $('#clienteModal').modal('hide');
            $('#colorModal').modal('hide');
            $('#reclamosModal').modal('hide');
        });

        // function data(){
        //     return {
        //         open:null,
        //         start(){
        //             this.open = false
        //         },
        //         isOpen(){
        //             this.open = !this.open
        //         },
        //         close(){
        //             this.open = false
        //         }
        //     }
        // }
    </script>
@endpush