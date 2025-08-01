<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostCategory extends Model
{
    protected $table = 'admincms_post_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];


    /* ======================================================================== *
	 * RELATIONS
	 * ======================================================================== */

    public function posts() {
        return $this->hasMany(Post::class);
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
