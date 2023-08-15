<x-zmodal id="clienteModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title">
        <h5>{{ $modal_title }}</h5>
    </x-slot> 
    <x-slot name="content">
        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <x-zform-input wire:model.lazy='cliente_razonsocial' name="cliente_razonsocial" label="Razón Social" placeholder='label' class="text-sm"/>
            </div>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-3">
                <x-zform-input wire:model.lazy='cliente_cuit' name="cliente_cuit" label="CUIT" placeholder='label' class="text-sm" />
            </div>
            <div class="col-md-3">
                <x-zform-input wire:model.lazy='cliente_telefono1' name="cliente_telefono1" label="Teléfono" placeholder='label' class="text-sm" />
            </div>
            <div class="col-md-4">
                <x-zform-input wire:model.lazy='cliente_correo' name="cliente_correo" label="Correo" placeholder='label' class="text-sm" />
            </div>
        </div>
        <div class="mb-3 g-2 row">
            <div class="col-md-4">
                <x-zform-input wire:model.lazy='cliente_calle_nombre' name="cliente_calle_nombre" label="Calle" placeholder='label' class="text-sm"/>
            </div>
            <div class="col-md-1">
                <x-zform-input wire:model.lazy='cliente_calle_numero' name="cliente_calle_numero" label="Nro." placeholder='label' class="text-sm"/>
            </div>
            <div class="col-md-2 mx-4">
                <x-zform-input wire:model.lazy='cliente_codigo_postal' name="cliente_codigo_postal" label="Cod.Postal" placeholder='label' class="text-sm"/>
            </div>
        </div>
        <div class="mb-3 g-2 row">
            <div class="col-md-5">
                <x-zform-input wire:model.lazy='cliente_barrio_nombre' name="cliente_barrio_nombre" label="Barrio" placeholder='label' class="text-sm"/>
            </div>
            <div class="col-md-5">
                <x-zform-input wire:model.lazy='cliente_localidad_nombre' name="cliente_localidad_nombre" label="Localidad" placeholder='label' class="text-sm"/>
            </div>
        </div>

    </x-slot>
    <x-slot name="footer">
        <div class="row row-cols-auto justify-content-between">
            <div class="col">
                <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModalCliente()" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar
                </button>
                <button class="btn btn-md btn-danger btn-sm" wire:click.prevent="grabarCliente()">
                    <i class="bi bi-check-circle-fill pe-1"></i>
                    Grabar
                </button>
            </div>
        </div>            
    </x-slot>
</x-zmodal>