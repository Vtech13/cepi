<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\User;


class Patient extends Model
{
    const MOTIFS = [
        'chirurgie_buccale'   => 'Chirurgie buccale',
        'esthetique_dentaire' => 'Esthétique dentaire',
        'parodontologie'      => 'Endodontie',
        'implantologie'       => 'Parodontologie',
        'endodontie'          => 'Implantologie',
    ];

    protected $fillable = [
        'status',
        'firstname',
        'lastname',
        'phone',
        'date_of_birth',
        'motif',
        'information',
        'created_user_id',
        'updated_user_id',
        'email'
    ];

    /* ======================================================================== *
     * --RELATIONS
     * ======================================================================== */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(PatientLog::class);
    }

    /**
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function confrere(): HasMany
    {
        return $this->hasMany(User::class, 'created_user_id');
    }

    /* ======================================================================== *
     * --GETTER - SETTER
     * ======================================================================== */

    public function getFullNameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
