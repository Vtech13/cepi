<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Pusher\Pusher;

class MessageController extends Controller { 
    
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $groups = Auth::user()->groups;
        $confreres = $this->getConfreres();
        return view('platform.admin.messages.index', compact('groups', 'confreres'));
    }

    private function getConfreres()
    {
        return $this->user->newQuery()
            ->where(function ($query) {
                $query->confrere()
                    ->orWhere->admin();
            })
            ->select(['id', 'firstname', 'lastname', 'created_at', 'login_at', 'login_link_sent_at'])
            ->orderBy('lastname')
            ->get();
    }

    public function show(Group $group)
    {
        $messages = $group->messages()->with('user')->get();
        $messages->transform(function ($message) {
            $message->formatted_created_at = $message->created_at->format('Y-m-d H:i:s'); // Changer le format selon vos besoins
            return $message;
        });

        $groupId = $group->id; // Ajoutez cette ligne

        $pusherKey = config('broadcasting.connections.pusher.key');
        $pusherCluster = config('broadcasting.connections.pusher.options.cluster');

        return view('platform.admin.messages.show', compact('group', 'messages', 'pusherKey', 'pusherCluster', 'groupId'));
    }

    public function store(Request $request, Group $group)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'content' => 'required|string',
            'file' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // Validez le fichier ici
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('public/files'); // Stockez le fichier et récupérez le chemin
        }

        // Dans votre méthode store dans MessageController.php
        $message = Message::create([
            'user_id' => auth()->id(), // Utilisez l'ID de l'utilisateur authentifié
            'group_id' => $validatedData['group_id'],
            'content' => $validatedData['content'],
            'file_path' => $filePath,
        ]);

        // Chargez l'objet user dans le message
        $message->load('user');

        // Assurez-vous d'avoir Pusher configuré correctement
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            config('broadcasting.connections.pusher.options')
        );
        
        // Formatez le nom du canal en fonction des ID triés
        $channelName = 'private-chat-' . $group->id;

        // Le nom de l'événement
        $eventName = 'new-message';

        // Le message à envoyer
        $data = ['message' => $message];

        // Déclencher l'événement
        $pusher->trigger($channelName, $eventName, $data);

        return back();
    }
}