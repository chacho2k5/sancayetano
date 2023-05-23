<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'razonsocial' => ['required','between:3,100'],
            'contacto' => ['required','alpha_num','between:3,100'],
            'correo' => ['required','email','unique:clientes,correo,' . $this->cliente->id],
            'cuit' => ['nullable','digits_between:10,11'],
            'iva_id' => ['nullable','digits:1'],
            'telefono1' => ['nullable','string','between:5,15'],
            'telefono2' => ['nullable','string','between:5,15'],
            'calle_nombre' => ['nullable','string','between:3,100'],
            'calle_numero' => ['nullable','digits_between:1,5'],
            'codigo_postal' => ['nullable','alpha_num','between:4,20'],
            'barrio_id' => ['nullable','digits_between:1,5'],
            'localidad_id' => ['nullable','digits_between:1,5'],
            'provincia_id' => ['nullable','digits_between:1,2'],
            'fecha_alta' => ['nullable','date'],
            'observaciones' => ['nullable'],
        ];

    }

    public function messages()
    {
        return [
            'razonsocial.required' => 'Debe ingresar la Razon Socialx',
        //     'razonsocial.between' => 'La Razon Social debe tener al menos 3 letras',
        //     'telefono1.required' => 'Debe ingresar el Nro. de Telefono',
        //     'telefono1.digits_between' => 'El Nro. de Teléfono debe tener mas de 6 dígitos',
        ];

        // return [
        //     // 'required' => 'The :attribute es requeridisimo.',
        //     'email' => 'El :attribute no es una direccion validaaaaaaaaa',
        //     // 'between' => 'The :attribute value :input debe estar entre :min - :max.',
        // ];

        // $messages = [
        //     'razonsocial.required' => 'Debe ingresar la Razon Socialxxxxxxxxxxxxxxxxxxxx',
        //     // 'razonsocial.between' => 'La Razon Social debe tener al menos 3 letras',
        //     // 'telefono1.required' => 'Debe ingresar el Nro. de Telefono',
        //     'telefono1.digits_between' => 'El Nro. de Teléfono debe tener mas de 6 dígitos',
        // ];

        // $attributes = [
        //     // 'required' => 'The :attribute es requeridisimo.',
        //     'email' => 'El :attribute no es una direccion validaaaaaaaaa',
        //     // 'between' => 'The :attribute value :input debe estar entre :min - :max.',
        // ];

        // return ([$messages, $attributes]);

    }

    public function attributes()
    {
    //         // the attributes method replaces the :attribute placeholder on the validation messages
    //         // with given attribute names

    //         // You can use the trans(...) helper function here to get your 'localized' from
    //         // resources/lang/{language}/{file}

    //         // set your default and fallback locale in the config/app.php file
    //         // I will assume you are using English ('en')
        return [
            'calle_nombre' => 'Nombre de la calle',
            'calle_numero' => 'Numero del domicilio',
        ];
    }

}
