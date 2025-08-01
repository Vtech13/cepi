<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'admincms_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sort',
        'created_user_id',
        'updated_user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /* ======================================================================== *
	 * RELATIONS
	 * ======================================================================== */

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
