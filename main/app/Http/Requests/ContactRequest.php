<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        // rules max is in kilobytes for files | 10000 = ~10MB
        return [
            'lastname'               => 'required|string|max:255',
            'firstname'              => 'required|string|max:255',
            'email'                  => 'required|string|email|max:255',
            'phone'                  => 'required|numeric',
            'date_of_birth'          => 'required|string|max:255',
            'address'                => 'required|string|max:255',
            'postal_code'            => 'required|string|max:20',
            'city'                   => 'required|string|max:255',
            'number_security_social' => 'required|string|max:255',
            'mutuelle'               => 'required|in:cmu,css,acs,autre',
            'motif'                  => 'required|in:chirurgie_buccale,esthetique_dentaire,parodontologie,implantologie,endodontie',
            'name_dentist'           => 'required|string|max:255',
            'message'                => 'required|string',
            'file'                   => 'required_unless:motif,esthetique_dentaire|file|mimes:jpeg,jpg,png,pdf|max:10000',
            'file_pano_dentaire'     => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:10000'
        ];
    }

    public function messages(): array
    {
        return [
            'lastname.required'          => 'Ce champs doit être rempli',
            'firstname.required'         => 'Ce champs doit être rempli',
            'email.required'             => 'Ce champs doit être rempli',
            'email.email'                => 'Ce champs doit être une adresse email',
            'phone.required'             => 'Ce champs doit être rempli',
            'phone.numeric'              => 'Ce champs doit être un numero de telephone',
            'date_of_birth.required'     => 'Ce champs doit être rempli',
            'address.required'           => 'Ce champs doit être rempli',
            'motif.required'             => 'Ce champs doit être rempli',
            'name_dentist.required'      => 'Ce champs doit être rempli',
            'message.required'           => 'Ce champs doit être rempli',
            'file.required_unless'       => 'Ce champ est obligatoire sauf si le motif est dans esthétique dentaire.',
        ];
    }
}
