<x-zmodal id="colorModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title">
        <h5>{{ $modal_title }}</h5>
    </x-slot> 
    <x-slot name="content">
        <div class="row g-3 mb-3">
            <div class="col-md-8">
                <x-zform-input wire:model.lazy='color_nuevo' name="color_nuevo" label="Nombre color" placeholder='label' class="text-sm"/>
            </div>
        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="row row-cols-auto justify-content-between">
            <div class="col">
                <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModalColor()" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar
                </button>
                <button class="btn btn-md btn-danger btn-sm" wire:click.prevent="grabarColor()">
                    <i class="bi bi-check-circle-fill pe-1"></i>
                    Grabar
                </button>
            </div>
        </div>            
    </x-slot>
</x-zmodal>