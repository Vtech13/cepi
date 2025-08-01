<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    const SU_ADMIN = 9;
    const ADMIN = 7;
    const CONFRERE = 5;
    const ADMINCMS = 3;

    protected $table = 'ref_user_roles';
}
