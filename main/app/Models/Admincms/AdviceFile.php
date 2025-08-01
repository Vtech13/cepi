<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;

class AdviceFile extends Model
{
    protected $table = 'admincms_advice_files';

    protected $fillable = [
        'name',
        'file',
        'sort'
    ];
}
