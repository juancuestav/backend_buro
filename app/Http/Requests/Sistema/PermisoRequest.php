<?php

namespace App\Http\Requests\Sistema;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
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
            'name' => $this->method() == 'POST' ? 'required|string|unique:permissions,name':'required|string'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => strtolower($this['name']),
            'guard_name' => 'web'
        ]);
    }
}
