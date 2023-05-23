<x-zmodal id="editModal" maxWidth="{{ $modal_width }}">
    <x-slot name="title">
        <h4>{{ $modal_title }}</h4>
    </x-slot>
    <x-slot name="content">
        @if ($modal_action == 'show')<fieldset disabled='disabled'>@endif
            <div class="row">
                <div class="form-group col-md-5">
                   <x-zform-input wire:model="razonsocial" name="razonsocial" label="Nombre del cliente" placeholder='label' autofocus />
                </div>

                <div class="form-group col-md-5">
                   <x-zform-input wire:model="contacto" name="contacto" label="Contacto" placeholder='label' autofocus />
                </div>
               </div>
               <div class="row">
                <div class="form-group col-md-5">
                    <x-zform-input wire:model="cuit" name="cuit" label="Cuit" placeholder='label' autofocus />
                </div>

                  <div class="form-group col-md-5 ">
                        <label for="">Tipo de Iva</label>
                        {{-- <div wire:ignore> --}}
                        <select wire:model="selectedIva" class="form-select form-select-sm @error('selectedIva') is-invalid @enderror" title="Debe seleccionar un tipo de Iva">
                            <option value="0">Seleccione tipo Iva</option>
                            @foreach($ivas as $iva)
                                <option value="{{ $iva->id }}">
                                    {{ $iva->nombre }}
                                </option>
                            @endforeach
                        </select>

                  </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-5 ">
                        <x-zform-input wire:model="telefono1" name="telefono1" label="Telefono_1" placeholder='label' autofocus />
                    </div>

                    <div class="form-group col-md-5 ">
                        <x-zform-input wire:model="telefono2" name="telefono2" label="Telefono_2" placeholder='label' autofocus />
                    </div>
                </div>

                <div class="form-group col-md-10">
                    <x-zform-input wire:model="correo" name="corre" label="E-mail" placeholder='label' autofocus />
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <x-zform-input wire:model="calle_nombre" name="calle_nombre" label="Direccion" placeholder='label' autofocus />
                    </div>

                    <div class="form-group col-md-4">
                        <x-zform-input wire:model="calle_numero" name="calle_numero" label="Numero" placeholder='label' autofocus />
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                         <x-zform-input wire:model="codigo_postal" name="codigo_postal" label="Codigo Postal" placeholder='label' autofocus />
                    </div>
                      <div class="form-group col-md-4">
                            <label for="fecha_alta" class="col-form-label-sm">Fecha de alta</label>
                            <input type="date" wire:model.lazy="fecha_alta" class="form-control form-control-sm @error('fecha_alta') is-invalid @enderror" autofocus title="Debe ingresar la fecha de alta (dia/mes/año).">
                      </div>
                 </div>
                <x-zform-area wire:model="observaciones" name="observaciones" label="Observaciones" />

        @if ($modal_action == 'show')</fieldset>@endif
    </x-slot>
    <x-slot name="footer">
        @if ($modal_action == 'show')
            <button class="btn btn-md btn-primary" wire:click="cancel">Volver...</button>
        @else
            <button class="btn btn-md btn-outline-secondary" wire:click="cancel" data-dismiss="modal" aria-label="Close">Cancelar</button>
            <button class="btn btn-md btn-success" wire:click="grabar">Grabar</button>
        @endif
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
        <button class="btn btn-md btn-secondary" wire:click="cancel" data-dismiss="modal" aria-label="Close">Cancelar</button>
        <button class="btn btn-md btn-danger" wire:click="delete">Borrar</button>
    </x-slot>
</x-zmodal>






