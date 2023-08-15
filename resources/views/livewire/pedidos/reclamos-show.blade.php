{{-- <div x-data="{ open:false, auxId: @entangle('selectedReclamo')}"> --}}
<div x-data="{ open:false, auxId: 0, reclamoDetalle: @entangle('reclamoDetalle')}">
    <x-zmodal id="reclamosModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title"> 
        <h4>{{ $modal_title }}</h4>
    </x-slot> 
    <x-slot name="content">
        <table class="table table-hover text-nowrap">
            <thead style="background-color: #4082B0; color: #dee2e6;">
                <tr>
                    <th>OT</th>
                    <th>INICIO</th>
                    <th>FINAL</th>
                    <th>RECLAMO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reclamosCliente as $reg)
                <tr id={{ $reg->id }} wire:click="showReclamoDetalle({{ $reg->id }})">
                        <td>{{ $reg->numero_ot }}</td>
                        <td>{{ $reg->reclamo_inicio == null ? '---' : date('d/m/Y', strtotime($reg->reclamo_inicio)) }}</td>
                        <td>{{ $reg->reclamo_final == null ? '---' : date('d/m/Y', strtotime($reg->reclamo_final)) }}</td>
                        <td title="{{ $reg->reclamo_detalle }}">{{ substr($reg->reclamo_detalle,0,50) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($reclamoDetalle)
            <div class="mt-2 form-group">
                <label for="reclamoDetalle" class="mb-1 form-label">Detalle del Reclamo</label>
                <textarea wire:model="reclamoDetalle" class="form-control" id="reclamoDetalle" name="reclamoDetalle" rows=8 disabled></textarea>
            </div>
        @endif
    </x-slot>
    <x-slot name="footer">
        <div class="row row-cols-auto justify-content-between">
            <div class="col">
                <button wire:click="cancelReclamoModal()" class="btn btn-md btn-success btn-sm">
                    <i class="bi bi-check-circle-fill pe-1"></i>
                    Cerrar
                </button>
            </div>
        </div>                
    </x-slot>
</x-zmodal>
</div>