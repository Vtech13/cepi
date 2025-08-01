<?php

namespace App\Http\Controllers\Admincms;

use App\Models\Admincms\Attachment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AttachmentsController extends Controller
{
    /**
     * @var Attachment
     */
    private $attachment;

    /**
     * AttachmentsController constructor.
     * @param Attachment $attachment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * AJAX CALL - delete
     *
     * @param Attachment $attachment
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Attachment $attachment)
    {
        if ($attachment->isImage) {
            Storage::disk('public')->delete(config('image.folder') . DIRECTORY_SEPARATOR . $attachment->name);
            Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . $attachment->name);
            Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . 'big_' . $attachment->name);
        }

        return $attachment->delete();
    }
}
