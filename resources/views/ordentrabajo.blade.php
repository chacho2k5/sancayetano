<x-app-layout>
    {{-- <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('css/datatables.custom.css') }}" class="rel">
    </x-slot> --}}

    {{-- <x-slot name="header">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h4>ORDEN DE TRABAJO</h4>
            </div>
        </div> 
    </x-slot> --}}

    {{-- <x-slot name="header">
        ORDEN DE TRABAJO
    </x-slot> --}}


    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12"> --}}
                @livewire('orden-trabajo.orden-trabajo-index')
            {{-- </div>
        </div>
    </div> --}}
</x-app-layout>