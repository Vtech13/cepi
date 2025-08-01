<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoverPasswordRequest;
use App\Mail\RecoverPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecoverPasswordController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create a token for user, send a mail with link to reset password
     *
     * @param RecoverPasswordRequest $request
     * @return RedirectResponse
     */
    public function __invoke(RecoverPasswordRequest $request): RedirectResponse
    {
        $user = $this->user->newQuery()
            ->select(['id', 'email', 'token'])
            ->where('email', $request->input('email-recover'))
            ->first();

        $user->fill(['token' => Str::random(60)])->save();

        Mail::to($user->email)->send(new RecoverPassword($user->token));

        return back()->with('success', 'Un email vous a été envoyé avec les instructions pour changer votre mot de passe.');
    }
}
