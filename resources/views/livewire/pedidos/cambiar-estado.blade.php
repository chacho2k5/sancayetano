<x-zmodal id="estadoModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title">
        <h5>{{ $modal_title }}</h5>
    </x-slot> 
    <x-slot name="content">

        <x-zform-input wire:model.lazy='estado_nombre' name="estado_nombre" label="Estado actual" placeholder='label' title="Estado actual del pedido." disabled />

        <div class="form-group col-md-auto">
            <label for="" class="col-form-label-sm">Nuevo Estado</label>
            <select wire:model="selectedNewEstado" class="mb-1 form-select form-select-md me-2" title="Debe seleccionar un estado.">
                <option value="0">Seleccione un estado</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-2">
            <x-zform-area wire:model.lazy='newEstadoObservaciones' rows=8 name="newEstadoObservaciones" label="Observaciones" placeholder='' />
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="row row-cols-auto justify-content-between">
            <div class="col">
                <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModal()" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar
                </button>
                <button class="btn btn-md btn-danger btn-sm" wire:click="grabarNuevoEstado()">
                    <i class="bi bi-check-circle-fill pe-1"></i>
                    Grabar
                </button>
            </div>
        </div>            
    </x-slot>
</x-zmodal>
