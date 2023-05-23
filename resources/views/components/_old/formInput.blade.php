{{--
placeholder -> ''
            -> label
            -> algun valor
. Definir valor OLD para la Edicion
. Definir algunos parametros de validacion
. Validacion Date (ver complementos)
 --}}

@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '0',
    'value' => ''
])

<div class="mt-4 form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        @error($name)
            {{ $attributes->merge(['class' => 'form-control is-invalid']) }}
        @else
            {{ $attributes->merge(['class' => 'form-control']) }}
        @enderror
        placeholder="{{ $placeholder == 'label' ? $label : ($placeholder == '0' ? '' : $placeholder)}}"

        {{-- Esto es para cdo se lo llama desde un ALTA y no trae valor x default, tbien se podria ver
        pasando el parametro "value" distinto --}}
        @if ($value == '')
            value="{{ old($name,'') }}">
        @else
            value="{{ old($name,$value->$name) }}">
        @endif

        @error($name)
            <span class="invalid-feedback" role="alert">
                <span class="text-danger">{{ $message }}</span>
            </span>
        @enderror
</div>
