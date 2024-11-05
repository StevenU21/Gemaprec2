<?php

namespace App\Http\Requests;

use App\Models\Maintenance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
class ActivityRequest extends FormRequest
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
            'description' => 'required|string',
            'activity_type_id' => 'required|exists:activity_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'maintenance_id' => 'required|exists:maintenances,id',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $maintenance = Maintenance::find($this->maintenance_id);

            if ($maintenance) {
                $activityStartDate = Carbon::parse($this->start_date);
                $activityEndDate = Carbon::parse($this->end_date);
                $maintenanceStartDate = Carbon::parse($maintenance->start_date);
                $maintenanceEndDate = Carbon::parse($maintenance->end_date);

                if ($activityStartDate->lt($maintenanceStartDate) || $activityEndDate->gt($maintenanceEndDate)) {
                    $validator->errors()->add('date', 'The activity dates must be within the maintenance period.');
                }
            }
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'message.required' => 'El mensaje es requerido',
            'activity_type_id.required' => 'El tipo de actividad es requerido',
            'date.required' => 'La fecha es requerida',
            'maintenance_id.required' => 'El mantenimiento es requerido'
        ];
    }
}
