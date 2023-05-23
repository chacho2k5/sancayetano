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
    'value',
    'sel' => ''
])

<div class="mt-4 form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'form-select']) }}>
        @foreach ($value as $val)
            <option value="{{ $val->id }}">
                {{ $val->descripcion}}
            </option>
        @endforeach
    </select>

</div>
