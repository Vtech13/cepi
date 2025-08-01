<?php

namespace App\View\Components;

use App\Models\Attachment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AttachmentPreview extends Component
{
    /**
     * @var Attachment
     */
    public $attachment;

    /**
     * @var string
     */
    public $delete;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Attachment $attachment, bool $delete = false)
    {
        $this->attachment = $attachment;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.attachment-preview');
    }
}
