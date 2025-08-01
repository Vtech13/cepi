<?php

namespace App\Models;

use App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attachment extends Model
{
    const TYPE_PDF = 'files';
    const TYPE_IMG = 'img';

    protected $fillable = [
        'type',
        'attachable_type',
        'attachable_id',
        'patient_id',
        'name',
        'created_user_id',
        'updated_user_id'
    ];

    /* ======================================================================== *
     * RELATIONS
     * ======================================================================== */

    public function attachable(): MorphTo
    {
        return $this->morphTo();
    }

    /* ======================================================================== *
     * METHODS
     * ======================================================================== */

    /**
     * @param bool $withBase
     * @return string
     */
    public function getPath(bool $withBase = true): string
    {
        $id = $this->attachable->id;
        $base = $withBase ? "app/" : "";
    
        if ($this->attachable_type === Patient::class) {
            return "{$base}patients/patient-$id/$this->name";
        } else {
            ///return "{$base}patients/patient-$this->patient_id";
            return "{$base}confreres/confrere-$this->confrere$id/$this->name";
        }
    }

    /**
     * @param array  $folder [base, name]
     * @param string $filename
     * @param string $ext
     * @return string
     */
    public function uniqFileName(array $folder, string $filename, string $ext): string
    {
        $path = storage_path($folder['base'] . $folder['name']) . DIRECTORY_SEPARATOR . $filename . '.' . $ext;

        if (file_exists($path)) {
            $num = 0;
            while (++$num) {
                $file = "$filename-$num.$ext";
                if (!file_exists(storage_path($folder['base'] . $folder['name']) . DIRECTORY_SEPARATOR . $file)) {
                    return $file;
                }
            }
        }

        return "$filename.$ext";
    }

}
