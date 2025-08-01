<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * ResetPasswordController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $token
     * @return Application|Factory|View|RedirectResponse
     */
    public function index(string $token)
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard')->with('warning', 'Vous êtes déjà connecté.');
        }

        $user = $this->user->newQuery()
            ->select(['id', 'firstname', 'lastname', 'password'])
            ->where('token', $token)->first();

        if (empty($user)) {
            return redirect()->route('admin.dashboard')->with('error', 'Ce lien n\'est plus valide.');
        }

        return view('auth.reset-password', [
            'class_body' => 'auth reset-password',
            'token'      => $token,
            'name'       => $user->firstname,
            'new'        => empty($user->password)
        ]);
    }

    /**
     * @param string               $token
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function store(string $token, ResetPasswordRequest $request): RedirectResponse
    {
        $user = $this->user->newQuery()
            ->select(['id', 'active', 'password'])
            ->where('token', $token)
            ->first();

        if (empty($user)) {
            return redirect()->route('admin.dashboard')->with('error', 'Ce lien n\'est plus valide.');
        }

        $user->update([
            'password' => Hash::make($request->input('password')),
            'active'   => empty($user->password) ? 1 : $user->active,
            'token'    => null
        ]);

        return redirect()->route('login')->with('success', 'Votre mot de passe a été mis a jour, vous pouvez maintenant vous connecter.');
    }
}
