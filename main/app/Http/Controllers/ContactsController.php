<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    /**
     * @param ContactRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ContactRequest $request)
    {
        if (!empty($request->input('prenom'))) {
            return redirect(route('home'))->with('error', 'Votre message n\'a pas été envoyé.');
        }

        if (!empty($request->file('file'))) {
            $file = $request->file('file')->store('contact');
        }

        if (!empty($request->file('file_pano_dentaire'))) {
            $filePanoDentaire = $request->file('file_pano_dentaire')->store('contact');
        }

        $contact = \App\Models\Admincms\Contact::query()->create(array_merge(
            $request->validated(),
            [
                'file'               => $file ?? null,
                'file_pano_dentaire' => $filePanoDentaire ?? null
            ]
        ));

        Mail::send(new Contact($contact));

        return redirect(route('home'))->with('success', 'Merci votre message a bien été envoyé.');
    }
}
