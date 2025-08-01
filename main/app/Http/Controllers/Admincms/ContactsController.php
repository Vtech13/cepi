<?php

namespace App\Http\Controllers\Admincms;

use App\Http\Controllers\Controller;
use App\Models\Admincms\Contact;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContactsController extends Controller
{
    public function index()
    {
        return view('admincms.contacts.index', [
            'class_body' => 'contacts',
            'contacts'   => Contact::query()
                ->orderBy('created_at', 'desc')
                ->paginate(100)
        ]);
    }

    public function show(Contact $contact)
    {
        return view('admincms.contacts.show', [
            'class_body' => 'contacts',
            'contact'    => $contact
        ]);
    }

    /**
     * Display a file in the browser only visible for authenticated user
     *
     * @param Contact $contact
     * @param string  $file
     * @return BinaryFileResponse
     */
    public function showFile(Contact $contact, string $file = 'file'): BinaryFileResponse
    {
        $file = $contact->$file;
        return response()->download(storage_path("app/$file"));
    }
}
