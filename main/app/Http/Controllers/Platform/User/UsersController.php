<?php

namespace App\Http\Controllers\Platform\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->isConfrere()) {
            return redirect()->route('admin.confreres');
        }

        $user = User::query()
            ->with([
                'attachments' => function (MorphMany $q) {
                    return $q->orderByDesc('created_at');
                }
            ])
            ->find($request->user()->id);

        $patients = $user->patients;

        return view('platform.user.index', [
            'class_body' => 'user user-index no-sidebar',
            'user' => $user,
            'patients' => $patients,
        ]);
    }
}
