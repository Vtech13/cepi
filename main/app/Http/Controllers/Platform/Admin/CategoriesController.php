<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\AttachmentsRepository;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use function back;

class CategoriesController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    /**
     * @var AttachmentsRepository
     */
    private $attachmentsRepository;

    /**
     * @param Category              $category
     * @param AttachmentsRepository $attachmentsRepository
     */
    public function __construct(Category $category, AttachmentsRepository $attachmentsRepository)
    {
        $this->category = $category;
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @throws Exception
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $category = $this->category->newQuery()->create(array_merge(
            ['created_user_id' => $request->user()->id],
            $request->validated()
        ));

        if ($request->has('files')) {
            foreach ($request->file('files') as $file) {
                $this->attachmentsRepository->storeFile(
                    $file,
                    Category::class,
                    $category->id,
                    $request->user()->id,
                );
            }
        }

        return back()->with('success', 'La catégorie a été ajouté.');
    }

    /**
     * @param Category        $category
     * @param CategoryRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Category $category, CategoryRequest $request): RedirectResponse
    {
        $category->update([
            'name'            => $request->input('name-' . $category->id),
            'information'     => $request->input('information-' . $category->id),
            'updated_user_id' => $request->user()->id
        ]);

        if ($request->has('files-' . $category->id)) {
            foreach ($request->file('files-' . $category->id) as $file) {
                $this->attachmentsRepository->storeFile(
                    $file,
                    Category::class,
                    $category->id,
                    $request->user()->id,
                );
            }
        }

        return back()->with('success', 'La catégorie a été modifié.');
    }

    public function destroy(Category $category)
    {
        $category->load('attachments');

        foreach ($category->attachments as $attachment) {
            $attachment->delete();
        }

        Storage::deleteDirectory("patients/patient-$category->patient_id/category-$category->id");

        $category->delete();

        return back()->with('success', 'La catégorie a été supprimée.');
    }
}
