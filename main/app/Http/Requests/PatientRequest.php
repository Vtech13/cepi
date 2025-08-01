<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firstname'     => 'required|max:255',
            'lastname'      => 'required|max:255',
            'date_of_birth' => 'required|max:255',
            'phone'         => 'required|max:100',
            'email'      => 'nullable|max:255',
            'motif'         => 'required'
        ];
    }
}
