<?php

namespace App\Http\Controllers\Admincms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect(route('office.pages.index'));

//        return view('admincms.dashboard');
    }
}
