<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $table = 'admincms_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'content',
        'status',
        'post_category_id',
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
     * @return MorphMany
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    /* ======================================================================== *
     * METHODS
     * ======================================================================== */

    /**
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
