<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Pusher\Pusher;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $group = new Group;
        // Récupérez les noms et prénoms des utilisateurs et des confrères
        $userNames = User::whereIn('id', array_merge([$request->confreres], [Auth::id()]))
                        ->get()
                        ->map(function ($user) {
                            return $user->firstname . ' ' . $user->lastname;
                        })
                        ->toArray();
                        
        // Joignez les noms et prénoms avec une virgule et ajoutez-les au nom du groupe
        $group->name = 'Groupe : ' . implode(', ', $userNames);
        $group->objet = $request->input('objet');
        $group->save();
    
        $group->users()->attach(Auth::id());
        if ($request->confreres) {
            $group->users()->attach($request->confreres);
        }

        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'file' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Validez le fichier ici
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('public/files'); // Stockez le fichier et récupérez le chemin
        }

        $message = Message::create([
            'user_id' => auth()->id(),
            'group_id' => $validatedData['group_id'],
            'file_path' => $filePath, // Stockez le chemin du fichier dans la base de données
        ]);

        $message->save();

    
        return redirect()->route('user.messages.show', $group);
    }
}