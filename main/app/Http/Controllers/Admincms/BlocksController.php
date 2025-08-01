<?php

namespace App\Http\Controllers\Admincms;

use App\Models\Admincms\Block;
use App\Http\Controllers\Controller;
use App\Repositories\AttachmentsAdminRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlocksController extends Controller
{
    /**
     * @var Block
     */
    private $block;

    /**
     * @var AttachmentsAdminRepository
     */
    private $attachmentsRepository;

    /**
     * BlocksController constructor.
     * @param Block $block
     * @param AttachmentsAdminRepository $attachmentsRepository
     */
    public function __construct(Block $block, AttachmentsAdminRepository $attachmentsRepository)
    {
        $this->block = $block;
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->block->newQuery()->create([
            'name' => $request->input('name'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'page_id' => $request->input('page_id'),
            'created_user_id' => $request->user()->id
        ]);

        return redirect()->back()->with('success', 'L\'information à bien été ajouté !');
    }

    /**
     * @param Block $block
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function update(Block $block, Request $request)
    {
        if ((int)$request->input('page_id_' . $block->id) !== $block->page_id) {
            return redirect()->back()->with('error', 'Error');
        }

        $request->validate([
            'image_' . $block->id => 'file|mimes:jpeg,bmp,png,gif|max:10000',
        ]);

        $block->name = !empty($request->input('name_' . $block->id)) ? $request->input('name_' . $block->id) : $block->name;
        $block->title = $request->input('title_' . $block->id);
        $block->content = $request->input('content_' . $block->id);
        $block->updated_user_id = $request->user()->id;
        $block->save();

        $file = $request->file('image_' . $block->id);

        if (!empty($file)) {
            if ($block->attachments()->exists()) {
                $fileOld = $block->attachments()->first();
                Storage::disk('public')->delete(config('image.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
                Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
                Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . 'big_' . $fileOld->name);
                $fileOld->delete();
            }

            $this->attachmentsRepository->storeFile($file, 'blocks', $block->id, $request->user()->id);
        }

        if (!empty($request->input('mov_' . $block->id))) {
            $code_video = explode('https://youtu.be/', $request->input('mov_' . $block->id));

            if (empty($code_video[1])) {
                return redirect()->back()->with('error', 'La vidéo n\'est pas dans le bon format');
            }

            $data = [];

            if (!empty($request->input('mov_title_' . $block->id))) {
                $data['title'] = $request->input('mov_title_' . $block->id);
            }

            $this->attachmentsRepository->storeVideo($code_video[1], 'blocks', $block->id, $request->user()->id, $data);
        }

        return redirect()->back()->with('success', 'L\'information à bien été modifié');
    }

}
