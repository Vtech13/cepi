<?php

namespace App\Http\Controllers\Admincms;

use App\Http\Controllers\Controller;
use App\Models\Admincms\Page;
use App\Repositories\AttachmentsAdminRepository;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PagesController extends Controller
{
    /**
     * @var string
     */
    private $class_body;
    /**
     * @var Page
     */
    private $page;

    /**
     * @var AuthManager
     */
    private $auth;
    /**
     * @var AttachmentsAdminRepository
     */
    private $attachmentsRepository;

    /**
     * PagesController constructor.
     * @param Page                       $page
     * @param AuthManager                $auth
     * @param AttachmentsAdminRepository $attachmentsRepository
     */
    public function __construct(Page $page, AuthManager $auth, AttachmentsAdminRepository $attachmentsRepository)
    {
        $this->class_body = 'pages';
        $this->page = $page;
        $this->auth = $auth;
        $this->attachmentsRepository = $attachmentsRepository;
    }

    public function index()
    {
        $pages = $this->page->newQuery()->get();

        return view('admincms.pages.index', [
            'class_body' => $this->class_body,
            'pages'      => $pages
        ]);
    }

    public function edit(Page $page)
    {
        $page->load([
            'blocks' => function (HasMany $q) {
                return $q->orderBy('sort');
            },
            'blocks.attachments'
        ]);

        foreach ($page->blocks as $block) {
            $file = $block->attachments()->first();

            if (!empty($file) && $file->isImage) {
                $this->attachmentsRepository->imageCache($file, 200, 200);
                $this->attachmentsRepository->imageCache($file, 1000, 1000);
            }
        }

        return view('admincms.pages.edit', [
            'class_body' => $this->class_body,
            'page'       => $page,
            'user'       => $this->auth->user()
        ]);
    }
}
