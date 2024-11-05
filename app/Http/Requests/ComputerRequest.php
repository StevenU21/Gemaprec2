<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComputerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'description' => 'string',
			'serial_number' => 'required|string',
			'mac_address' => 'required|string',
			'adquisition_date' => 'required|string',
			'status' => 'required|string',
			'brand_id' => 'required',
			'pc_model_id' => 'required',
			'ubications_id' => 'required',
			'pc_type_id' => 'required',
            'client_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'description.string' => 'La descripción debe ser un texto',
            'serial_number.required' => 'El número de serie es requerido',
            'mac_address.required' => 'La dirección MAC es requerida',
            'adquisition_date.required' => 'La fecha de adquisición es requerida',
            'status.required' => 'El estado es requerido',
            'brand_id.required' => 'La marca es requerida',
            'pc_model_id.required' => 'El modelo es requerido',
            'ubications_id.required' => 'La ubicación es requerida',
            'pc_type_id.required' => 'El tipo de computadora es requerido',
            'client_id.required' => 'El cliente es requerido',
        ];
    }
}
