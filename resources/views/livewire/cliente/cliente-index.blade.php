<div> 
    <div class="px-0 container-fluid">
        <header class="py-2 h4 d-flex">
            <div class="container">
                <h4>CLIENTES</h4>
            </div>
        </header>
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
                <button wire:click="createModal" class="btn btn-primary btn-md ps-1">
                    <i class="bi bi-plus-circle-fill pe-1 ps-1"></i>
                    Nuevo cliente
                </button>
            </div>
        </div>

        <table class="table table-bordered table-hover table-responsive table-light">
            {{-- <thead class="table-primary table-active"> --}}
            <thead class="table-dark table-active">
            <tr>
                <th scope="col" style="cursor: pointer;"
                        wire:click='order("razonsocial")'>
                        RAZON SOCIAL
                        @if ($sort == 'razonsocial')
                            @if ($direction == 'asc')
                                <i class="mt-1 float-end fa-solid fa-sort-up"></i>
                            @else
                                <i class="mt-1 float-end fa-solid fa-sort-down"></i>
                            @endif
                        @else
                            <i class="mt-1 float-end fa-solid fa-sort"></i>
                        @endif
                </th>
                <th scope="col">CUIT</th>
                <th scope="col">CORREO</th>
                <th scope="col">TELEFONO</th>
                <th scope="col" class="text-center">ACCION</th>
            </tr>
            </thead>
            <tbody>
                @foreach ( $registros as $reg)
                <tr>
                    <td>{{ $reg->razonsocial }}</td>
                    <td>{{ $reg->cuit }}</td>
                    <td>{{ $reg->correo }}</td>
                    <td>{{ $reg->telefono1 }}</td>
                    <td class="text-center">
                        <button wire:click.prevent="editModal({{ $reg->id }}, 'show')" class="btn btn-light-success" data-toggle="tooltip" title='Mostrar datos.'>
                            <i class="bi bi-eye text-success text-bold text-md-center"></i>
                        </button>
                        <button wire:click="editModal({{ $reg->id }}, 'edit')" class="btn btn-light-primary" data-toggle="tooltip" title='Actualizar datos.'>
                            <i class="bi bi-pencil-fill text-primary text-bold text-md-center"></i>
                        </button>
                        <button wire:click="deleteModal({{ $reg->id }})" class="btn btn-light-danger" data-toggle="tooltip" title='Borrar'>
                            <i class="bi bi-trash text-danger text-bold text-md-center"></i>
                        </button>
                        {{-- <button wire:click.prevent="delete({{ $reg->id }})" class="btn btn-light-danger" data-toggle="tooltip" title='Borrar'
                            onclick="confirm('Esta seguro de borrar? - {{ $reg->id }}') || event.stopImmediatePropagation()">
                            <i class="bi bi-trash text-danger text-bold text-md-center"></i>
                        </button> --}}
                    </td>
                </tr>
            @endforeach 
            </tbody>
        </table>
        <div class="pagination justify-content-end">
            {{ $registros->links() }}
        </div>
        @include('livewire.cliente.cliente-edit')
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
