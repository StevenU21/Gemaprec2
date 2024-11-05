<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequest extends FormRequest
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
        $rules = [
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'observations' => 'required|string',
            'status' => 'string',
            'maintenance_type_id' => 'required|exists:maintenance_types,id',
        ];

        if ($this->isMethod('post')) {
            $rules['computer_id'] = 'required|exists:computers,id';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['computer_id'] = 'sometimes|exists:computers,id';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'description.required' => 'La descripción es requerida',
            'description.string' => 'La descripción debe ser una cadena de texto',
            'start_date.required' => 'La fecha de inicio es requerida',
            'start_date.date' => 'La fecha de inicio debe ser una fecha',
            'start_date.after_or_equal' => 'La fecha de inicio debe ser igual o posterior a la fecha actual',
            'start_date.string' => 'La fecha de inicio debe ser una cadena de texto',
            'end_date.required' => 'La fecha de fin es requerida',
            'end_date.string' => 'La fecha de fin debe ser una cadena de texto',
            'end_date.date' => 'La fecha de fin debe ser una fecha',
            'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio',
            'observations.required' => 'Las observaciones son requeridas',
            'observations.string' => 'Las observaciones deben ser una cadena de texto',
            'status.string' => 'El estado debe ser una cadena de texto',
            'computer_id.required' => 'El ID de la computadora es requerido',
            'maintenance_type_id.required' => 'El ID del tipo de mantenimiento es requerido',
        ];
    }
}
