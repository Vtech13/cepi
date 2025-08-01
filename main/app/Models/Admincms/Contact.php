<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'admincms_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'postal_code',
        'city',
        'number_security_social',
        'mutuelle',
        'file_pano_dentaire',
        'motif',
        'name_dentist',
        'file',
        'message'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
