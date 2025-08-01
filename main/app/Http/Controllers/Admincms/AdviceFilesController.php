<?php

namespace App\Http\Controllers\Admincms;

use App\Http\Controllers\Controller;
use App\Models\Admincms\AdviceFile;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdviceFilesController extends Controller
{
    private $class_body = 'advice-files pages';

    private function storeFile(UploadedFile $file): string
    {
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $ext = $file->getClientOriginalExtension();

        $uniqName = (new Attachment())->uniqFileName(['base' => 'app/public/', 'name' => 'advice-files'], $filename, $ext);

        $file->storePubliclyAs('advice-files', $uniqName, ['disk' => 'public']);

        return $uniqName;
    }

    public function index()
    {
        return view('admincms.advice-files.index', [
            'class_body' => $this->class_body,
            'files'      => AdviceFile::query()->get()
        ]);
    }

    public function create()
    {
        return view('admincms.advice-files.create', [
            'class_body' => $this->class_body
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'file' => 'required|file|mimes:pdf'
        ]);

        /** @var UploadedFile $file */
        $file = $validated['file'];

        $uniqName = $this->storeFile($file);

        AdviceFile::query()->create([
            'name' => $validated['name'],
            'file' => $uniqName
        ]);

        return redirect()->route('office.advice-files.index')->with('success', 'La fiche conseil à bien été ajouté');
    }

    public function edit(AdviceFile $adviceFile)
    {
        return view('admincms.advice-files.edit', [
            'class_body' => $this->class_body,
            'file'       => $adviceFile
        ]);
    }

    public function update(AdviceFile $adviceFile, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf'
        ]);

        if (!empty($validated['file'])) {
            /** @var UploadedFile $file */
            $file = $validated['file'];

            // Delete old file
            Storage::delete("public/advice-files/$adviceFile->file");
            // Store new one
            $uniqName = $this->storeFile($file);
        }

        $adviceFile->update([
            'name' => $validated['name'],
            'file' => $uniqName ?? $adviceFile->file
        ]);

        return redirect()->route('office.advice-files.index')->with('success', 'La fiche conseil à bien été mise a jour');
    }

    public function destroy(AdviceFile $adviceFile)
    {
        Storage::delete("public/advice-files/$adviceFile->file");
        $adviceFile->delete();
        return redirect()->route('office.advice-files.index')->with('success', 'La fiche conseil à bien été supprimée');
    }
}
