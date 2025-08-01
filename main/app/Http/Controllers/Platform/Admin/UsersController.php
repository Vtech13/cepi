<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Http\Controllers\Controller;
use function view;

class UsersController extends Controller
{
    /**
     * @var string
     */
    private $class_body;

    /**
     * @var string
     */
    private $link_active;

    public function __construct()
    {
        $this->class_body = 'page-users no-sidebar';
        $this->link_active = 'users';
    }

    public function index()
    {
        return view('platform.admin.users.index', [
            'class_body'  => $this->class_body,
            'link_active' => $this->link_active
        ]);
    }
}
