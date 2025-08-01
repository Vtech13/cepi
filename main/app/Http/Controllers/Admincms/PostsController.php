<?php

namespace App\Http\Controllers\Admincms;

use App\Http\Controllers\Controller;
use App\Models\Admincms\Post;
use App\Models\Admincms\PostCategory;
use App\Repositories\AttachmentsAdminRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostsController extends Controller
{
    /**
     * @var string
     */
    private $class_body;

    /**
     * @var Post
     */
    private $post;

    /**
     * @var AttachmentsAdminRepository
     */
    private $attachmentsRepository;

    /**
     * PostsController constructor.
     * @param Post                  $post
     * @param AttachmentsAdminRepository $attachmentsRepository
     */
    public function __construct(Post $post, AttachmentsAdminRepository $attachmentsRepository)
    {
        $this->class_body = 'posts';
        $this->post = $post;
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = $this->post->newQuery()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admincms.posts.index', [
            'class_body' => $this->class_body,
            'posts' => $posts
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admincms.posts.create', [
            'class_body' => $this->class_body,
            'categories' => PostCategory::all()
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:admincms_posts|max:255',
            'image' => 'file|mimes:jpeg,bmp,png,gif|max:10000'
        ]);

        $slug = Str::slug($request->input('name'));

        $slug_q = $this->post->newQuery()->where('slug', $slug)->first();

        if (!empty($slug_q)) {
            return redirect()->back()->with('error', 'L\'article ne peux être ajouté car un article du meme nom a déja été creer avant (meme url)');
        }

        $post = $this->post->newQuery()->create([
            'title'            => $request->input('title'),
            'slug'             => $request->input('title'),
            'content'          => $request->input('content'),
            'status'           => 'online',
            'post_category_id' => $request->input('post_category_id'),
            'created_user_id'  => $request->user()->id
        ]);

        $file = $request->file('image');

        if (!empty($file)) {
            $this->attachmentsRepository->storeFile($file, 'posts', $post->id, $request->user()->id);
        }

        return redirect()->back()->with('success', 'L\'article à bien été ajouté');
    }

    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        if ($post->attachments()->exists()) {
            $file = $post->attachments()->first();

            if ($file->isImage) {
                $this->attachmentsRepository->imageCache($file);
                $this->attachmentsRepository->imageCache($file, 1000, 1000);
            }
        }

        return view('admincms.posts.edit', [
            'class_body' => $this->class_body,
            'post'       => $post,
            'categories' => PostCategory::all()
        ]);

    }

    public function update(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'file|mimes:jpeg,bmp,png,gif|max:10000'
        ]);

        $slug = Str::slug($request->input('title'));

        $slug_q = $this->post->newQuery()
            ->where('id', '!=', $post->id)
            ->where('slug', $slug)
            ->first();

        if (!empty($slug_q)) {
            return redirect()->back()->with('error', 'L\'article ne peux être ajouté car un article du meme nom a déja été creer avant (meme url)');
        }

        $file = $request->file('image');

        if (!empty($file)) {
            if ($post->attachments()->exists()) {
                $fileOld = $post->attachments()->first();
                Storage::disk('public')->delete(config('image.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
                Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
                Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . 'big_' . $fileOld->name);
                $fileOld->delete();
            }
            $this->attachmentsRepository->storeFile($file, 'posts', $post->id, $request->user()->id);
        }

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->post_category_id = $request->input('post_category_id');
        $post->updated_user_id = $request->user()->id;
        $post->save();

        return redirect()->back()->with('success', 'L\'article à bien été modifié');
    }

    /**
     * @param Post $post
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        if ($post->attachments()->exists()) {
            $fileOld = $post->attachments()->first();
            Storage::disk('public')->delete(config('image.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
            Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
            Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . 'big_' . $fileOld->name);
            $fileOld->delete();
        }

        if ($post->delete()) {
            return redirect(route('office.posts.index'))->with('success', 'L\'article à bien été supprimé');
        } else {
            return redirect()->back()->with('error', 'Un problème est survenu lors de la suppression de l\'article');
        }
    }

    /**
     * @param Post $post
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroyAttachment(Post $post)
    {
        if ($post->attachments()->exists()) {
            if ($post->attachments()->first()->isImage) {
                $fileOld = $post->attachments()->first();
                Storage::disk('public')->delete(config('image.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
                Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . $fileOld->name);
                Storage::disk('public')->delete(config('imagecache.folder') . DIRECTORY_SEPARATOR . 'big_' . $fileOld->name);
                $fileOld->delete();
            } else {
                $post->attachments()->first()->delete();
            }
        }

        return redirect()->back()->with('success', 'Le medias à bien été supprimé.');
    }
}
