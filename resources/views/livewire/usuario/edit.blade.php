<x-jet-dialog-modal wire:model="open_modal">
    <x-slot name="title">
        {{ $titulo_modal }}
    </x-slot>

    <x-slot name="content">
        @if ($action == 'show')<fieldset disabled='disabled'>@endif

            <x-formInputw wire:model="descripcion" name="descripcion" label="Nombre del estado" placeholder='label' autofocus />
            <x-formInputw wire:model="detalle" name="detalle" label="Descripción" placeholder='label' autofocus />

        @if ($action == 'show')</fieldset>@endif
    </x-slot>

    <x-slot name="footer">
        @if ($action == 'show')
            <x-jet-secondary-button wire:click="cancel" class="btn-sm">
                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                Volver
            </x-jet-secondary-button>
        @else
            <x-jet-secondary-button wire:click="cancel" class="btn-sm">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click='grabar' class="btn-sm">
                Grabar
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
