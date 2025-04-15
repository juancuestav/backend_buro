<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class VerificarCuentaRequest extends FormRequest
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
            'documento_identidad_anverso' => 'required|string',
            'documento_identidad_reverso' => 'required|string',
            'documento_identidad_selfie' => 'required|string',
            'estado_verificacion' => 'nullable|string',
            'user_id' => 'required|numeric|integer|exists:users,id',
        ];
    }
}
