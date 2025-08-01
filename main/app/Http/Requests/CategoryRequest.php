<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if (empty($this->category)) {
            return [
                'patient_id'  => 'required|exists:patients,id',
                'name'        => 'required',
                'information' => 'nullable',
                'files'       => 'required'
            ];
        } else {
            return [
                'name-' . $this->category->id        => 'required',
                'information-' . $this->category->id => 'nullable',
                'files-' . $this->category->id       => 'nullable'
            ];
        }
    }
}
