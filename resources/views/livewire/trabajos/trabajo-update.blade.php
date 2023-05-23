    <x-zmodal id="trabajoModal" maxWidth="{{ $modal_width }}">
        <x-slot name="title">
            <h5>{{ $modal_title }}</h5>
            <h6>{{ 'Nro. OT: ' . $numero_ot . ' - Trabajo: ' . $trabajo_nombre }}</h6>
        </x-slot> 
        <x-slot name="content"> 
                <div class="mt-2 mb-4 row g-3">
                    <div class="col-md-3">
                        {{-- <x-zform-input wire:model='cantidad_bolsas_trabajo' name="cantidad_bolsas_trabajo" label="Cant. Bolsas Trabajo - Cant. Pedido ({{ $cantidad_bolsas }})" placeholder='label' /> --}}
                        <x-zform-input wire:model='cantidad_bolsas_trabajo' name="cantidad_bolsas_trabajo" label="Cant. Bolsas" placeholder='label' />
                    </div>
                    <div class="col-md-3">
                        <x-zform-input wire:model='bultos' name="bultos" label="Bultos" placeholder='label' />
                    </div>
                </div>
                <div class="mb-3 row g-3">
                    <div class="col-md-4">
                    <x-zform-input wire:model='precio_unitario' name="precio_unitario" label="Precio Unitario" placeholder='label' />
                    </div>
                    <div class="col-md-4">
                        <x-zform-input wire:model='precio_iva' name="precio_iva" label="IVA" placeholder='label' />
                    </div>
                    <div class="col-md-4">
                        <x-zform-input wire:model='precio_total' name="precio_total" label="Precio Total" placeholder='label' />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <x-zform-area wire:model.lazy='observaciones' name="observaciones" label="Observaciones" placeholder='label' />
                    </div>
                </div>

        </x-slot>
        <x-slot name="footer">
            <div class="row row-cols-auto justify-content-between">
                <div class="col">
                    <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModal" data-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar
                    </button>
                    <button class="btn btn-md btn-danger btn-sm" wire:click="grabarTrabajo">
                        <i class="bi bi-check-circle-fill pe-1"></i>
                        Grabar
                    </button>
                </div>
            </div>            
        </x-slot>
    </x-zmodal>

    <x-zmodal id="deleteModal" maxWidth="md">
        <x-slot name="title">
            <h4>{{ $modal_title }}</h4>
        </x-slot>
        <x-slot name="content">
            <h5>{{ $modal_content }}</h5>
        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-md btn-secondary" wire:click="cancelModal" data-dismiss="modal" aria-label="Close">Cancelar</button>
            <button class="btn btn-md btn-danger" wire:click="delete">Borrar</button>
        </x-slot>
    </x-zmodal>
{{-- </div> --}}