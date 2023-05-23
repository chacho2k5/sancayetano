<x-app-layout>
    <x-slot name="header">

        @if (!auth()->check())
            <h2 class="h4 font-weight-bold">
            {{--   DASHBOARD --}}
                {{-- __('Dashboard') --}}
            </h2>
        @endif
        
        @auth
            <livewire:panel.panel-index>
        @endauth

    </x-slot>

    {{-- <x-jet-welcome /> --}}
    
</x-app-layout>