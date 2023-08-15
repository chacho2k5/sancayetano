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
    'focus' => '0',
    'err' => '1'
])

<div class="mb-0 form-group">
    <label for="{{ $name }}" class="mb-1 text-sm form-label form-label-sm">{{ $label }}</label>
    <input type="{{ $type }}"
        name="{{ $name }}"
        @error($name)
            {{ $attributes->merge(['class' => 'form-control form-control-sm is-invalid']) }}
        @else
            {{ $attributes->merge(['class' => 'form-control form-control-sm']) }}
        @enderror
        placeholder="{{ $placeholder == 'label' ? $label : ($placeholder == '0' ? '' : $placeholder)}}" 
        {{ $focus == '1' ? ' autofocus' : '' }}
        >
        {{-- @if ($err == '1') --}}
            @error($name)
                <span class="invalid-feedback" role="alert">
                    <span class="text-danger">{{ $message }}</span>
                </span>
            @enderror
        {{-- @endif --}}
</div>
