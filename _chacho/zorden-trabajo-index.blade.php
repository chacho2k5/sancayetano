<div>
    <div class="px-0 mx-0 container-fluid">
        {{-- <header class="py-2 d-flex"> --}}
            <div class="mt-2 mb-4 container-fluid">
                <h5>ORDEN TRABAJO</h5>
            </div>
        {{-- </header> --}}
        {{-- <div class="mb-1 row row-cols-2"> --}}
        <div class="mb-1 row row-cols-auto justify-content-between">
            <div class="col d-flex">
                <input type="text" class="flex-1 me-3 form-control form-control-md" placeholder="Ingrese busqueda..." wire:model="search">
                <button wire:click="exportExcel" class="btn btn-success me-1" data-toggle="tooltip" title='Exportar a Excel'>
                    <i class="bi bi-file-earmark-bar-graph"></i>
                </button>
                <button wire:click="exportPdf" class="btn btn-danger" data-toggle="tooltip" title='Exportar a Pdf'>
                    <i class="bi bi-filetype-pdf"></i>
                </button> 
            </div>
            <div class="col">
                <a href="{{ route('ots.create') }}" class="btn btn-primary btn-md ps-1"><i class="bi bi-plus-circle-fill pe-1 ps-1"></i>Nueva Orden Trabajo</a>
            </div>
        </div>

        {{-- <table class="table table-striped table-hover table-responsive table-light"> --}}
        {{-- <table class="table table-striped table-hover table-responsive"> --}}
        {{-- <table class="table table-hover" style="display:block; height:400px; overflow-y: scroll"> --}}
        <div class="table-responsive">
        {{-- <table class="table w-auto text-nowrap table-hover my-table table-sticky table-scroll table-responsive-md"> --}}
        <table class="table table-hover">
            {{-- <thead class="text-uppercase" style="background-color: #4a4f55; color: #dee2e6;"> --}}
            {{-- <thead class="text-uppercase" style="background-color: #375a7f; color: #eff3f7;"> --}}
            <thead class="align-middle">
            <tr>
                <th style="width: 45rem" scope="col" class="cursor-pointer col"
                        wire:click='order("razonsocial")'>
                        FECHA PEDIDO
                        @if ($sort == 'razonsocial')
                            {{-- @if ($direction == 'asc')
                                <i class="mt-1 float-end fa-solid fa-sort-up"></i>
                            @else
                                <i class="mt-1 float-end fa-solid fa-sort-down"></i>
                            @endif --}}
                        @else
                            {{-- <i class="mt-1 float-end fa-solid fa-sort"></i> --}}
                        @endif
                </th>
                <th style="width: 45rem">FECHA ENTREGA</th>
                <th style="width: 80rem">CLIENTE</th>
                <th style="width: 60rem">TRABAJO</th>
                <th style="width: 200rem" class="text-center">A-L-E</th>
                <th style="width: 40rem" class="text-center">CANT.</th>
                <th style="width: 60rem" class="text-center">COLOR</th>
                <th style="width: 30rem" class="text-center">T</th>      {{-- Tratamiento --}}
                <th style="width: 30rem" class="text-center">F</th>      {{-- FUELLE --}}
                <th style="width: 40rem" class="text-center">Corte</th>
                {{-- <th scope="col">P.UNIT</th>
                <th scope="col">TOTAL</th> --}}
                <th style="width: 50rem" class="overflow-ellipsis">OBSERVACIONES</th>
                <th style="width: 140rem" class="text-center">ACCION</th>
            </tr>
            </thead>
            {{-- Con esta clase se cambio el color del hover sobre la grilla
            <tbody class="thover"> --}}
            <tbody>
                @foreach ( $registros as $reg)
                <tr>
                    <td>{{ $reg->fecha_pedido }}</td>
                    <td>{{ $reg->fecha_entrega }}</td>
                    <td>{{ $reg->razonsocial }}</td>
                    <td>{{ $reg->trabajo_nombre }}</td>
                    <td>{{ $reg->ancho . ' - ' . $reg->largo . ' - ' . $reg->espesor }}</td>
                    <td>{{ $reg->cantidad_bolsas }}</td>
                    <td>{{ $reg->color->nombre }}</td>
                    <td>{{ $reg->tratado->nombre }}</td>
                    {{-- @if ($reg->bolsa_fuelle)
                        {{ $reg->bolsa_fuelle }}
                    @else
                        {{ $reg->bolsa_nombre }}
                    @endif --}}
                    <td>{{ $reg->bolsa_largo_fuelle }}</td>
                    <td>{{ $reg->corte->nombre }}</td>
                    {{-- <td>{{ $reg->precio_unitario }}</td>
                    <td>{{ $reg->precio_total }}</td> --}}
                    <td style="width: 50rem" class="overflow-ellipsis">{{ $reg->observaciones }}</td>

                    <td style="width: 140rem" class="text-center">
                        <button wire:click.prevent="editModal({{ $reg->id }}, 'show')" class="btn btn-light-success" data-toggle="tooltip" title='Mostrar datos.'>
                            <i class="bi bi-eye text-success text-bold text-md-center"></i>
                        </button>
                        <button wire:click="editModal({{ $reg->id }}, 'edit')" class="btn btn-light-primary" data-toggle="tooltip" title='Actualizar datos.'>
                            <i class="bi bi-pencil-fill text-primary text-bold text-md-center"></i>
                        </button>
                        <button wire:click="deleteModal({{ $reg->id }})" class="btn btn-light-danger" data-toggle="tooltip" title='Borrar'>
                            <i class="bi bi-trash text-danger text-bold text-md-center"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="pagination justify-content-end">
            {{ $registros->links() }}
        </div>
        @include('livewire.orden-trabajo.orden-trabajo-edit')

    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('show-edit-modal', event =>{
                $('#editModal').modal('show');
        });

        window.addEventListener('show-delete-modal', event =>{
                $('#deleteModal').modal('show');
        });

        // window.addEventListener('show-modal', event =>{
        //     if (event.detail.id) {
        //         var id = document.getElementById(event.detail.id)
        //         $(id).modal('show');
        //     } else {
        //         $('#zModal').modal('show');
        //     }
        // });

        window.addEventListener('close-modal', event =>{
            $('#deleteModal').modal('hide');
            $('#editModal').modal('hide');
        });
    </script>
@endpush
