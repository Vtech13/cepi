<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfrereRequest extends FormRequest
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
        $validation = [
            'firstname'   => 'required',
            'lastname'    => 'required',
            'information' => 'nullable'
        ];

        if (!empty($this->confrere)) {
            $validation += [
                'email' => [
                    'required', 'email:rfc,filter,dns',
                    Rule::unique('users')->ignore($this->confrere->id)
                ]
            ];
        } else {
            $validation += [
                'email' => 'required|email:rfc,filter,dns|unique:users',
            ];
        }

        return $validation;
    }
}
