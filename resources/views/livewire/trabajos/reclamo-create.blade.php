{{-- <div x-data="{ open:false }"> --}}
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
            <div class="row row-cols-auto justify-content-between">
                @if ($reclamo)
                    <div class="col">
                        <button class="btn btn-md btn-success btn-sm" wire:click="editarReclamo('borrar')" data-dismiss="modal" aria-label="Close" title="Se borrará el Reclamo">
                            <i class="bi bi-x-circle-fill"></i>
                            Borrar Reclamo
                        </button>
                    </div>
                @endif
                <div class="col">
                    <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModal()" data-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x-circle-fill"></i>
                        Cancelar
                    </button>
                    <button x-bind:disabled="auxDesactivar" class="btn btn-md btn-danger btn-sm" wire:click="editarReclamo('grabar')">
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