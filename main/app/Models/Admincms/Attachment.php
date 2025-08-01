<?php

namespace App\Models\Admincms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{

    protected $table = 'admincms_attachments';

    /**
     * Allow every fill to be fillable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $appends = ['url', 'urlCache'];

    /**
     * @return MorphTo
     */
    public function attachable() {
        return $this->morphTo();
    }

    /* ======================================================================== *
     * MUTATOR
     * ======================================================================== */

    public function getUrlAttribute() {
        return Storage::disk('public')->url(DIRECTORY_SEPARATOR.config('image.folder').DIRECTORY_SEPARATOR.$this->name);
    }

    public function getUrlCacheAttribute() {
//        dd(Storage::disk('public'));
        return Storage::disk('public')->url(DIRECTORY_SEPARATOR.config('imagecache.folder').DIRECTORY_SEPARATOR.$this->name);
    }

    public function getUrlBigCacheAttribute() {
        return Storage::disk('public')->url(DIRECTORY_SEPARATOR.config('imagecache.folder').DIRECTORY_SEPARATOR.'big_'.$this->name);
    }

    public function getIsImageAttribute() {
        return $this->type === 'img';
    }

    public function getIsVideoAttribute() {
        return $this->type === 'mov';
    }

    public function getIsPdfAttribute() {
        return $this->type === 'pdf';
    }

    /* ======================================================================== *
     * METHODS
     * ======================================================================== */

    public function uploadFile(UploadedFile $file) {
        $file = $file->storePublicly(config('image.folder'), ['disk' => 'public']);
        $this->name = basename($file);
        return $this;
    }
}
