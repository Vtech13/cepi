<?php

namespace App\Http\Controllers\Platform\User;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Patient;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;
use function back;
use function response;
use function storage_path;

class FilesController extends Controller
{
    /**
     * Display a file in the browser only visible for authenticated user
     *
     * @param Attachment $attachment
     * @return BinaryFileResponse
     * @throws AuthorizationException
     */
    public function show(Attachment $attachment): BinaryFileResponse
    {
        $this->authorize('view', $attachment);

        return response()->file(storage_path($attachment->getPath()));
    }

    /**
     * @param Attachment $attachment
     * @return bool|null
     */
    public function destroy(Attachment $attachment): ?bool
    {
        Storage::delete($attachment->getPath(false));
        return $attachment->delete();
    }

    /**
     * @throws AuthorizationException
     */
    public function downloadAll(Patient $patient)
    {
        $this->authorize('show', $patient);

        $patient->load('categories');

        $files = Storage::allFiles('patients/patient-' . $patient->id);

        if (empty($files)) {
            return back()->with('warning', 'Il n\'y a aucun documents à télécharger.');
        }

        Storage::makeDirectory('to-be-download');

        $path = storage_path('app/to-be-download');
        $zipFileName = Str::slug($patient->fullName) . '-' . time() . '.zip';
        $zip = new ZipArchive();

        if ($zip->open($path . '/' . $zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($patient->categories as $category) {
                $zip->addEmptyDir(Str::slug($category->name));

                foreach ($category->attachments as $attachment) {
                    $zip->addFile(storage_path('app/' . $attachment->getPath(false)), Str::slug($category->name) . '/' . $attachment->name);
                }
            }

            $zip->close();

            return response()->download($path . DIRECTORY_SEPARATOR . $zipFileName)->deleteFileAfterSend();
        }

        return back()->with('error', 'Un problème est survenue.');
    }

    /**
     * @throws AuthorizationException
     */
    public function downloadOne(Attachment $attachment)
    {
        $this->authorize('view', $attachment);

        return Storage::download($attachment->getPath(false));


//        return back()->with('error', 'Un problème est survenue.');
    }
}
