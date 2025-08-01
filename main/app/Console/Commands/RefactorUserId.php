<?php

namespace App\Console\Commands;

use App\Models\Admincms\Attachment;
use App\Models\Admincms\Block;
use App\Models\Admincms\Page;
use App\Models\Admincms\Post;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Console\Command;

class RefactorUserId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:refactor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refactor created_user_id for Admin CMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $user = User::query()
            ->select('id')
            ->where('ref_user_role_id', UserRole::ADMINCMS)->first();

        $attachments = Attachment::all();
        $blocks = Block::all();
        $pages = Page::all();
        $posts = Post::all();

        foreach ($attachments as $attachment) {
            $attachment->update(['created_user_id' => $user->id]);
        }
        foreach ($blocks as $block) {
            $block->update(['created_user_id' => $user->id, 'updated_user_id' => $user->id]);
        }
        foreach ($pages as $page) {
            $page->update(['created_user_id' => $user->id, 'updated_user_id' => $user->id]);
        }
        foreach ($posts as $post) {
            $post->update(['created_user_id' => $user->id, 'updated_user_id' => $user->id]);
        }

        $this->info('All user_id has been refactor.');
    }
}
