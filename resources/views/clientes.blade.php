<x-app-layout>
    {{-- <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('css/datatables.custom.css') }}" class="rel">
    </x-slot> --}}

    {{-- <x-slot name="header">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4>TABLA DE CLIENTES</h4>
            </div>
        </div>
    </x-slot> --}}

    {{-- <x-slot name="header">
        TABLA DE CLIENTES
    </x-slot> --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('cliente.cliente-index')
            </div>
        </div>
    </div>
</x-app-layout>