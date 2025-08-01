<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ref_user_role_id',
        'firstname',
        'lastname',
        'email',
        'password',
        'information',
        'ip',
        'active',
        'token',
        'created_user_id',
        'updated_user_id',
        'last_login_at',
        'login_at',
        'login_link_sent_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'active'             => 'boolean',
        'last_login_at'      => 'datetime',
        'login_at'           => 'datetime',
        'login_link_sent_at' => 'datetime'
    ];

    /* ======================================================================== *
     * --RELATIONS
     * ======================================================================== */

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(UserRole::class, 'ref_user_role_id');
    }

    /**
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class, 'created_user_id');
    }

    public function confrere(): HasMany
    {
        return $this->hasMany(User::class, 'created_user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    /* ======================================================================== *
     * --GETTER - SETTER
     * ======================================================================== */

    /**
     * @return string
     */
    public function getIconLetterAttribute(): string
    {
        $first = ucfirst(substr($this->firstname, 0, 1));
        $second = ucfirst(substr($this->lastname, 0, 1));
        return "$first$second";
    }

    public function getFullNameAttribute(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /* ======================================================================== *
     * --METHODS
     * ======================================================================== */

    public function isSuAdmin(): bool
    {
        return $this->ref_user_role_id === UserRole::SU_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->ref_user_role_id === UserRole::ADMIN;
    }

    public function isConfrere(): bool
    {
        return $this->ref_user_role_id === UserRole::CONFRERE;
    }

    /**
     * ONLY for the ADMIN CMS...
     * @return bool
     */
    public function getIsSuAdminAttribute()
    {
        return $this->email === 'dev@webcorporate.fr';
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeConfrere(Builder $query): Builder
    {
        return $query->where('ref_user_role_id', UserRole::CONFRERE);
    }
    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('ref_user_role_id', UserRole::ADMIN);
    }
    public function scopeSuAdmin(Builder $query): Builder
    {
        return $query->where('ref_user_role_id', UserRole::SU_ADMIN);
    }
}
