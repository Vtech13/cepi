<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function redirect;
use function view;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->isConfrere()) {
            return redirect()->route('user.users');
        }

        return view('platform.admin.index', [
            'class_body'  => 'dashboard no-sidebar',
            'link_active' => 'dashboard'
        ]);
    }
}
