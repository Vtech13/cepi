<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserRole;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->user()->ref_user_role_id === UserRole::ADMINCMS) {
                $route = route('office.dashboard');
            } else {
                $route = !$request->user()->isConfrere() ? route('admin.confreres') : route('user.users');
            }
            return redirect()->route($route)->with('message', 'Vous êtes déjà connecté.');
        }

        return view('auth.login', [
            'class_body' => 'auth login',
        ]);
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $credentials = array_merge(
            $request->only('email', 'password'),
            ['active' => 1]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Auth::logoutOtherDevices($credentials['password']);

            $user = $request->user();
            $user->ip = $request->getClientIp();
            $user->last_login_at = $user->login_at;
            $user->login_at = now();
            $user->save();

            if ($user->ref_user_role_id === UserRole::ADMINCMS) {
                $route = route('office.dashboard');
            } else {
                $route = !$user->isConfrere() ? route('admin.confreres') : route('user.users');
            }

            return redirect()->intended($route)->with('success', 'Vous êtes connecté.');
        }

        return back()->with('error', 'Votre mot de passe ou email sont incorrect.')->withInput();
    }
}
