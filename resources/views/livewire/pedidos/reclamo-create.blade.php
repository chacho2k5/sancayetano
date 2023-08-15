<x-zmodal id="reclamoModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title">
        <h5>{{ $modal_title }}</h5>
    </x-slot> 
    <x-slot name="content">
        <div class="mt-2">
            <x-zform-area wire:model.lazy='reclamo_detalle' rows=8 name="reclamo_detalle" label="Detalle del Reclamo" placeholder='' />
        </div>
    </x-slot>
    <x-slot name="footer">
        {{-- <div class="row row-cols-auto justify-content-between"> --}}
        {{-- <div class="row row-cols-auto justify-content-start"> --}}
        <div class="d-flex bd-highlight">
            @if ($reclamo)
                {{-- <div class="p-2 bd-highlight">
                    <button class="btn btn-md btn-success btn-sm" wire:click="editarReclamo('borrar')" data-dismiss="modal" aria-label="Close" title="Se borrará el Reclamo">
                        <i class="bi bi-x-circle-fill"></i>
                        Borrar Reclamo
                    </button>
                </div> --}}
                <div class="p-2 bd-highlight">
                    <button class="btn btn-md btn-success btn-sm" wire:click="finalizarReclamo()" data-dismiss="modal" aria-label="Close" title="Se borrará el Reclamo">
                        <i class="bi bi-x-circle-fill"></i>
                        Finalilzar Reclamo
                    </button>
                </div> 
            @endif
            <div class="p-2 bd-highlight">
                <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModalReclamo()" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle-fill"></i>
                    Cancelar
                </button>
            </div>
            <div class="p-2 bd-highlight">
                <button x-bind:disabled="auxDesactivar" class="btn btn-md btn-danger btn-sm" wire:click="grabarReclamo()">
                    <i class="bi bi-check-circle-fill pe-1"></i>
                    Grabar
                </button>
            </div>
        </div>            
    </x-slot>
</x-zmodal>