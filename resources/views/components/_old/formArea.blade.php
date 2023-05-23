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
    'placeholder' => '',
    'value' => ''
])

<div class="mt-4 form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}"
        @error($name)
            {{ $attributes->merge(['class' => 'form-control is-invalid']) }}
        @else
            {{ $attributes->merge(['class' => 'form-control']) }}
        @enderror
        placeholder="{{ $placeholder == 'label' ? $label : ($placeholder == '' ? '' : $placeholder)}}">{{ $value == '' ? old($name,'') : old($name,$value->$name)}}</textarea>
        {{-- Usando la directiva @if siempre se sumaba un espacio al inicio --}}
        {{-- @if ($value == '') {{old($name)}} @else {{old($name,$value->$name)}} @endif --}}
        @error($name)
            <span class="invalid-feedback" role="alert">
                <span class="text-danger">{{ $message }}</span>
            </span>
        @enderror
</div>
