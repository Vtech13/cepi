<?php

namespace App\Repositories;

use App\Models\Admincms\Attachment;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class AttachmentsAdminRepository
{

    /**
     * @param Attachment $file
     * @param int        $w
     * @param int        $h
     * @return \Intervention\Image\Image
     */
    public function imageCache(Attachment $file, $w = 400, $h = 400)
    {
        $file_name = $w >= 1000 ? 'big_' . $file->name : $file->name;

        return Image::cache(function ($image) use ($file, $w, $h, $file_name) {
            $image->make(storage_path('app/public/' . config('image.folder') . DIRECTORY_SEPARATOR . $file->name))
                ->resize($w, $h, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(storage_path('app/public/' . config('imagecache.folder') . DIRECTORY_SEPARATOR . $file_name));
        }, config('imagecache.lifetime'));
    }

    /**
     * @param UploadedFile $file
     * @param string       $type
     * @param int          $id
     * @param int          $user_id
     * @return Attachment
     */
    public function storeFile(UploadedFile $file, string $type, int $id, int $user_id)
    {
        $attachment = new Attachment([
            'attachable_type' => $type,
            'attachable_id'   => $id,
            'created_user_id' => $user_id,
            'type'            => 'img'
        ]);
        $attachment->uploadFile($file);
        $attachment->save();
        return $attachment;
    }

    public function storeVideo(string $name, string $type, int $id, int $user_id, array $data = null)
    {
        $attachment = new Attachment([
            'attachable_type' => $type,
            'attachable_id'   => $id,
            'created_user_id' => $user_id,
            'type'            => 'mov',
            'name'            => $name,
            'title'           => !empty($data['title']) ? $data['title'] : null
        ]);
        $attachment->save();
        return $attachment;
    }
}
