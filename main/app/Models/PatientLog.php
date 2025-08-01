<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientLog extends Model
{
    protected $fillable = [
        'patient_id',
        'user_id',
        'value'
    ];

    protected $casts = [
        'value' => 'array'
    ];

    /* ======================================================================== *
     * RELATIONS
     * ======================================================================== */

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
