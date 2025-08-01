<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Block extends Model
{
    protected $table = 'admincms_blocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id',
        'name',
        'title',
        'content',
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

    /**
     * @return BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
