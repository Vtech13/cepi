<?php

namespace App\Http\Controllers;

use App\Models\Admincms\Post;
use App\Models\Admincms\PostCategory;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * @var Post
     */
    private $post;

    /**
     * PostsController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

//    public function index()
//    {
//        return view('posts.index', [
//            'class_body'   => 'posts',
//            'posts'        => $this->post->newQuery()->orderByDesc('created_at')->get(),
//            'latest_posts' => $this->post->newQuery()->orderByDesc('created_at')->limit(5)->get(),
//            'categories'   => $this->getCatForSidebar()
//        ]);
//    }

    public function view($slug)
    {
        $post = $this->post->newQuery()->where('slug', $slug)->firstOrFail();

        $latest_posts = $this->post->newQuery()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('posts.view', [
            'class_body'   => 'posts conseils-patients',
            'post'         => $post,
            'latest_posts' => $latest_posts,
            'categories'   => $this->getCatForSidebar()
        ]);
    }

    public function viewCategory($slug)
    {
        $postCategory = new PostCategory();

        $category = $postCategory->newQuery()->where('slug', $slug)->firstOrFail();

        $latest_posts = $this->post->newQuery()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('posts.view-category', [
            'class_body'   => 'posts',
            'category'     => $category,
            'latest_posts' => $latest_posts,
            'categories'   => $this->getCatForSidebar()
        ]);
    }

    private function getCatForSidebar()
    {
        $postCat = new PostCategory();

        return $postCat->newQuery()->has('posts')->get();
    }
}
