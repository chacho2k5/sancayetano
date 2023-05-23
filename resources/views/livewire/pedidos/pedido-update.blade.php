<div> 
    <div class="container-fluid">
        <div x-data="{ open:false, auxId: @entangle('selectedArticulo') }" @keydown.enter.prevent="$focus.next()">
            <form wire:submit.prevent="grabar" autocomplete="off" class="needs-validation">
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
                                <button wire:click.prevent='grabarOT' class="btn btn-danger btn-sm ps-1 ms-2" tabindex="0">
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
                                    <label for="" class="mb-1 text-xs form-label form-label-sm">Cliente</label>
                                    <div class="row gx-2">
                                        <div class="col-10">
                                            <select wire:model="selectedCliente" class="form-select form-select-sm me-2 mb-1 @error('selectedCliente') is-invalid @enderror" title="Debe seleccionar un cliente.">
                                                <option value="0">Seleccione un cliente</option>
                                                @foreach($clientes as $cliente)
                                                    <option value="{{ $cliente->id }}">
                                                        {{ $cliente->razonsocial }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            @if ($selectedCliente)
                                                <button wire:click.prevent="trabajosModal({{ $selectedCliente }})" class="btn btn-outline-success btn-sm" data-toggle="tooltip" title='Mostrar trabajos.'>
                                                    {{-- <i class="bi bi-eye text-outline-success text-bold text-sm-center"></i> --}}
                                                    Trabajos
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 offset-md-2">
                                <x-zform-input wire:model.lazy='numero_ot' name="numero_ot" label="Nro. Orden Trabajo" placeholder='label' title="Nro. de la 'Orden de Trabajo'." disabled />
                            </div>
                        </div> 
                        <div class="mb-2 row">
                            <div class="col-md-2">
                                <x-zform-input wire:model='cantidad_bolsas' name="cantidad_bolsas" label="Cant. Bolsas" placeholder='label' />
                            </div>
                            <div class="col-md-2">
                                <x-zform-input wire:model='metros' name="metros" label="Metros" placeholder='label' disabled />
                            </div>
                            <div class="col-md-2">
                                <x-zform-input wire:model='peso' name="peso" label="Peso" placeholder='label' disabled/>
                            </div>
                            {{-- <div class="col-md-4 offset-md-6">
                              <div class="row">
                                <div class="col-md-6">
                                    <x-zform-input wire:model='metros' name="metros" label="Metros" placeholder='label' disabled />
                                </div>
                                <div class="col-md-6">
                                    <x-zform-input wire:model='peso' name="peso" label="Peso" placeholder='label' disabled/>
                                </div>
                              </div> --}}
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-4">
                                <x-zform-input wire:model.lazy='trabajo_nombre' name="trabajo_nombre" label="Nombre Trabajo" placeholder='label' title="Debe ingresar el 'Nombre del Trabajo'." />
                            </div>
                            <div class="col-md-2">
                                <x-zform-input wire:model.lazy='ancho' name="ancho" label="Ancho" placeholder='label' />
                            </div>
                            <div class="col-md-2">
                                <x-zform-input wire:model.lazy='largo' name="largo" label="Largo" placeholder='label' />
                            </div>
                            <div class="col-md-2">
                                <x-zform-input wire:model.lazy='espesor' name="espesor" label="Espesor" placeholder='label' />
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Colores</label>
                                <select wire:model="selectedColor" class="form-select form-select-sm @error('selectedCorte') is-invalid @enderror" title="Debe seleccionar un color.">
                                    <option value="0">Seleccione un color</option>
                                    @foreach($colores as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Tipo Material</label>
                                <select wire:model="selectedMaterial" class="form-select form-select-sm @error('selectedMaterial') is-invalid @enderror" title="Debe seleccionar un material.">
                                    <option value="0">Seleccione el material</option>
                                    @foreach($materiales as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Tipo Bolsa</label>
                                <select wire:model="selectedBolsa" class="form-select form-select-sm @error('selectedBolsa') is-invalid @enderror" title="Debe seleccionar un tipo de bolsa.">                                
                                    <option value="0">Seleccione el tipo de bolsa</option>
                                    @foreach($bolsas as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            @if ($bolsa_fuelle == true)
                                <div class="mt-1 col-md-2 ">
                                    <x-zform-input wire:model.lazy='bolsa_largo_fuelle' name="bolsa_largo_fuelle" label="Largo fuelle" placeholder='label' />
                                </div>
                            @endif
    
                        </div>
                        <div class="mb-2 row">
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Tratados</label>
                                <select wire:model="selectedTratado" class="form-select form-select-sm @error('selectedTratado') is-invalid @enderror" title="Debe seleccionar un tratado.">
                                    <option value="0">Seleccione un tratado</option>
                                    @foreach($tratados as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group col-md-3">
                                <label for="" class="col-form-label-sm">Tipo de Cortes</label>
                                <select wire:model="selectedCorte" class="form-select form-select-sm @error('selectedCorte') is-invalid @enderror" title="Debe seleccionar un tipo de corte.">
                                    <option value="0">Seleccione un tipo de corte</option>
                                    @foreach($cortes as $reg)
                                        <option value="{{ $reg->id }}">
                                            {{ $reg->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
    
                        </div>
                        <div class="row">
                        <x-zform-area wire:model.lazy='observaciones' name="observaciones" label="Observaciones" placeholder='label' />
                            
                        </div>

                        {{-- <div class="card-footer"></div> --}}
                </div>      {{-- End Card --}}
                @if ($action == 'show')</fieldset>@endif
            </form>
        </div>
    </div>
    @include('livewire.pedidos.articulos-show')

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
            $('#reclamoModal').modal('hide');
            $('#estadoModal').modal('hide');
            $('#imprimirModal').modal('hide');
        });

        function data(){
            return {
                open:null,
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
@endpush