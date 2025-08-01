<?php

namespace App\Repositories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class AttachmentsRepository
{
    /**
     * @var Attachment
     */
    private $attachment;

    /**
     * AttachmentsRepository constructor.
     * @param Attachment $attachment
     */
    public function __construct(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \Exception
     */
    private function getType(UploadedFile $file): string
    {
        $fileType = explode('/', $file->getMimeType());

        if ($file->getMimeType() === 'application/pdf') {
            return 'files';
        }

        if ($fileType[0] === 'image') {
            return 'img';
        }

        abort(500, 'File extension');
    }

    /**
     * @param UploadedFile $file
     * @param string       $attachableType
     * @param int          $attachableId
     * @param int          $createdUserId
     * @param int|null     $patientId
     * @return Builder|Model
     * @throws \Exception
     */
    public function storeFile(UploadedFile $file, string $attachableType, int $attachableId, int $createdUserId, int $patientId = null)
    {
        $attachment = $this->attachment->newQuery()->make([
            'type'            => $this->getType($file),
            'attachable_type' => $attachableType,
            'attachable_id'   => $attachableId,
            'created_user_id' => $createdUserId,
            'patient_id'      => $patientId
        ]);

        // File get unique name
        $folder = [
            'base' => 'app/',
            'name' => $attachment->getPath(false)
        ];
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $ext = $file->getClientOriginalExtension();

        $filename = $this->attachment->uniqFileName($folder, $filename, $ext);

        // Store file
        $file->storeAs($folder['name'], $filename);

        // Save attachment
        $attachment->name = $filename;
        $attachment->save();

        return $attachment;
    }
}
