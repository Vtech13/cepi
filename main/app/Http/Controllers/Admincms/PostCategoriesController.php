<?php

namespace App\Http\Controllers\Admincms;

use App\Http\Controllers\Controller;
use App\Models\Admincms\PostCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostCategoriesController extends Controller
{
    private $class_body;

    /**
     * @var PostCategory
     */
    private $postCategory;

    /**
     * PostCategoriesController constructor.
     * @param PostCategory $postCategory
     */
    public function __construct(PostCategory $postCategory)
    {
        $this->class_body = 'posts';
        $this->postCategory = $postCategory;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admincms.post-categories.index', [
            'class_body' => $this->class_body,
            'categories' => $this->postCategory->newQuery()->get()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admincms.post-categories.create', [
            'class_body' => $this->class_body
        ]);
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:admincms_post_categories|max:255',
        ]);

        $slug = Str::slug($request->input('name'));

        $slug_q = $this->postCategory->newQuery()->where('slug', $slug)->first();

        if (!empty($slug_q)) {
            return redirect()->back()->with('error', 'La categorie ne peux être ajouté car une categories du meme nom a déja été creer avant (meme url)');
        }

        $this->postCategory->newQuery()->create([
            'name' => $request->input('name'),
            'slug' => $request->input('name'),
        ]);

        return redirect(route('office.posts-categories.index'))->with('success', 'La categorie à bien été ajouté');
    }

    /**
     * @param PostCategory $postCategory
     * @return Application|Factory|View
     */
    public function edit(PostCategory $postCategory)
    {
        return view('admincms.post-categories.edit', [
            'class_body' => $this->class_body,
            'postCategory' => $postCategory
        ]);
    }

    /**
     * @param PostCategory $postCategory
     * @param Request      $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(PostCategory $postCategory, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $slug = Str::slug($request->input('name'));

        $slug_q = $this->postCategory->newQuery()
            ->where('id', '!=', $postCategory->id)
            ->where('slug', $slug)
            ->first();

        if (!empty($slug_q)) {
            return redirect()->back()->with('error', 'La categorie ne peux être ajouté car une categories du meme nom a déja été creer avant (meme url)');
        }

        $postCategory->name = $request->input('name');
        $postCategory->save();

        return redirect(route('office.posts-categories.index'))->with('success', 'La categorie à bien été modifié');
    }

    /**
     * @param PostCategory $postCategory
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(PostCategory $postCategory)
    {
        if ($postCategory->posts()->exists()) {
            return redirect()->back()->with('error', 'Des articles sont attacher a cette category, vous devez d\'abord enlever les articles de cette categorie avant de la supprimer');
        }

        if ($postCategory->delete()) {
            return redirect(route('office.posts-categories.index'))->with('success', 'La categorie à bien été supprimé');
        } else {
            return redirect()->back()->with('error', 'Un problème est survenu lors de la suppression de la categorie');
        }
    }
}
