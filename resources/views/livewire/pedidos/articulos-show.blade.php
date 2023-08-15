<div x-data="{ open:false, auxId: @entangle('selectedArticulo'), auxDesactivar: @entangle('btnDesactivar') }">
    <x-zmodal id="articulosModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title"> 
        <h4>{{ $modal_title }}</h4>
    </x-slot> 
    <x-slot name="content">
        {{-- <table class="table table-hover my-table-modal thover"> --}}
        <table class="table table-hover text-nowrap">
            <thead style="background-color: #4082B0; color: #dee2e6;">
                <tr>
                    <th>TRABAJO</th>
                    <th>A-L-E</th>
                    <th>COLOR</th>
                    <th>T</th>      {{-- Tratamiento --}}
                    <th>F</th>      {{-- FUELLE --}}
                    <th>Corte</th>
                </tr>
            </thead>
            {{-- <tbody class="my-body-table-modal"> --}}
            <tbody>
                @foreach ($articulos_ot as $articulo)
                        <tr id={{ $articulo->id }} x-on:click="auxId=$el.id, auxDesactivar=false" x-bind:class="{'selRowModal':$el.id == auxId}">
                        <td title="{{ $articulo->trabajo_nombre }}">{{ substr($articulo->trabajo_nombre,0,30) }}></td>
                        <td>{{ $articulo->ancho . ' - ' . $articulo->largo . ' - ' . $articulo->espesor }}</td>
                        <td>{{ $articulo->color->nombre }}</td>
                        <td>{{ $articulo->tratado->nombre }}</td>
                        <td>{{ $articulo->bolsa_largo_fuelle }}</td>
                        <td>{{ $articulo->corte->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
    <x-slot name="footer">
        <div class="mx-auto row col-md-12">
            <div class="col">
                <button x-bind:disabled="auxDesactivar" class="btn btn-md btn-success btn-sm" wire:click="cambiarEstadoTrabajo()" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-file-x-fill"></i>
                    {{ $trabajo_boton_activar }}
                </button>
            </div>
        <div class="col col-md-auto">            
            <button class="btn btn-md btn-secondary btn-sm" wire:click="cancelModal" data-dismiss="modal" aria-label="Close">
                <i class="bi bi-x-circle-fill"></i>
                Cerrar
            </button>
            @if ($activar_trabajo)
                <button x-bind:disabled="auxDesactivar" class="btn btn-md btn-danger btn-sm" wire:click="selectModal">
                    <i class="bi bi-check-circle-fill pe-1"></i>
                    Elejir trabajo
                </button>
            @endif
        </div>
    </x-slot>
</x-zmodal>
</div>