<?php

namespace App\Http\Requests\Reporte;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * @property mixed $file
 */
class ArchivoReporteRequest extends FormRequest
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
        $rules = [
            'titulo' => 'nullable|string',
            'user_id' => 'required|numeric|integer',
            'subido_por_user_id' => 'required|numeric|integer',
            'reporte_id' => 'required|numeric|integer',
            'file' => 'nullable',
        ];

        /* if ($this->isMethod('post')) {
            $rules['user_id'] = 'required|numeric|integer';
            $rules['reporte_id'] = 'required|numeric|integer';
        } */


        if ($this->isMethod('patch')) {
            $rules['user_id'] = 'nullable|numeric|integer';
            $rules['reporte_id'] = 'nullable|numeric|integer';
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
//        $titulo = '';//$this->method() === 'PATCH' ? $this->input('titulo') : $this->file->getClientOriginalName();

        $this->merge([
            'user_id' => $this['user'],
            'subido_por_user_id' => Auth::id(),
            'reporte_id' => $this['reporte'],
        ]);
    }
}
