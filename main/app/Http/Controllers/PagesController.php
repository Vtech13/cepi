<?php

namespace App\Http\Controllers;

use App\Models\Admincms\AdviceFile;
use App\Models\Admincms\Page;
use App\Models\Admincms\Post;
use App\Models\Admincms\PostCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PagesController extends Controller
{
    /**
     * @var Page
     */
    private $page;

    /**
     * PagesController constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $post_db = new Post();
        $posts = $post_db->newQuery()->orderByDesc('created_at')->limit(3);

        $page = $this->page->newQuery()->where('name', 'home')->first();

        return view('pages.index', [
            'class_body'  => 'home',
            'blocks'      => $this->_getBlocks($page),
            'posts'       => $posts->get(),
            'posts_count' => $posts->count()
        ]);
    }

    public function cabinet()
    {
        $page = $this->page->newQuery()->where('name', 'clinique-cepi')->first();

        return view('pages.cabinet', [
            'class_body' => 'cabinet',
            'blocks'     => $this->_getBlocks($page)
        ]);
    }

    /**
     * Page soins > chirurgie buccale
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function chirurgieBuccale()
    {
        $page = $this->page->newQuery()->where('name', 'chirurgie-buccale')->first();

        return view('pages.chirurgie-buccale', [
            'class_body' => 'nos-soins chirurgie-buccale',
            'blocks'     => $this->_getBlocks($page),
        ]);
    }

    /**
     * Page soins > esthetique dentaire
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function esthetiqueDentaire()
    {
        $page = $this->page->newQuery()->where('name', 'esthetique-dentaire')->first();

        return view('pages.esthetique-dentaire', [
            'class_body' => 'nos-soins esthetique-dentaire',
            'blocks'     => $this->_getBlocks($page),
        ]);
    }

    /**
     * Page soins > endodontie
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function endodontie()
    {
        $page = $this->page->newQuery()->where('name', 'endodontie')->first();

        return view('pages.endodontie', [
            'class_body' => 'nos-soins endodontie',
            'blocks'     => $this->_getBlocks($page),
        ]);
    }

    /**
     * Page soins > parodontologie
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function parodontologie()
    {
        $page = $this->page->newQuery()->where('name', 'parodontologie')->first();

        return view('pages.parodontologie', [
            'class_body' => 'nos-soins parodontologie',
            'blocks'     => $this->_getBlocks($page),
        ]);
    }

    /**
     * Page soins > implantologie
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function implantologie()
    {
        $page = $this->page->newQuery()->where('name', 'implantologie')->first();

        return view('pages.implantologie', [
            'class_body' => 'nos-soins implantologie',
            'blocks'     => $this->_getBlocks($page),
        ]);
    }

    public function conseilsPatients()
    {
        $page = $this->page->newQuery()->where('name', 'espace-patients')->first();

        return view('pages.conseils-patients', [
            'class_body'   => 'conseils-patients',
            'blocks'       => $this->_getBlocks($page),
            'posts'        => Post::query()->orderByDesc('created_at')->get(),
            'latest_posts' => Post::query()->orderByDesc('created_at')->limit(5)->get(),
            'categories'   => PostCategory::query()->has('posts')->get(),
            'advice_files' => AdviceFile::query()->orderByDesc('sort')->get()
        ]);
    }

    public function espacesPraticiens()
    {
        $page = $this->page->newQuery()->where('name', 'espace-correspondants')->first();

        return view('pages.espaces-praticiens', [
            'class_body' => 'espaces-praticiens',
            'blocks'     => $this->_getBlocks($page)
        ]);
    }

    public function videosUtiles()
    {
        $page = $this->page->newQuery()->where('name', 'video-utiles')->first();

        return view('pages.videos-utiles', [
            'class_body' => 'videos-utiles',
            'blocks'     => $this->_getBlocks($page)
        ]);
    }

    public function mentionsLegales()
    {
        $page = $this->page->newQuery()->where('name', 'mentions-legales')->first();

        return view('pages.mentions-legales', [
            'class_body' => 'mentions-legales',
            'blocks'     => $this->_getBlocks($page),
        ]);
    }

    public function contact()
    {
        return view('pages.contact', [
            'class_body' => 'contact'
        ]);
    }

    /**
     * @param Page $page
     * @return array|object[]
     */
    private function _getBlocks(Page $page)
    {
        $blocks = [];

        foreach ($page->blocks as $k => $v) {
            $attachments = [];

            if (!empty($v->attachments->first())) {
                if ($v->attachments->first()->isImage) {
                    $attachments['image'] = $v->attachments()->first();
                } else {
                    foreach ($v->attachments as $attachment) {
                        $attachments['videos'][] = $attachment;
                    }
                }
            }

            $blocks += [
                $v->name => (object)[
                    'id'      => $v->id,
                    'title'   => $v->title,
                    'content' => $v->content,
                    'image'   => !empty($attachments['image']) ? $attachments['image'] : null,
                    'videos'  => !empty($attachments['videos']) ? $attachments['videos'] : null,
                ]
            ];
        }

        return $blocks;
    }
}
