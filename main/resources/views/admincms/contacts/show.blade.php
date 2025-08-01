@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">{{ $contact->firstname. ' ' . $contact->lastname}}</h1>

        <div class="line-separation"></div>

        <div>
            <table rules="all" style="border-color: #666;" cellpadding="10">
                <tr>
                    <td><strong>Date</strong></td>
                    <td>
                        {{ $contact->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Nom</strong></td>
                    <td>
                        {{ $contact->lastname }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Prénom</strong></td>
                    <td>
                        {{ $contact->firstname }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </td>
                </tr>
                <tr>
                    <td><strong>Téléphone</strong></td>
                    <td>
                        {{ $contact->phone }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Date de naissance</strong></td>
                    <td>
                        {{ $contact->date_of_birth }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Adresse</strong></td>
                    <td>
                        {{ $contact->address }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Code postal</strong></td>
                    <td>
                        {{ $contact->postal_code }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Ville</strong></td>
                    <td>
                        {{ $contact->city }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Numéro de sécurité social</strong></td>
                    <td>
                        {{ $contact->number_security_social }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Mutuelle</strong></td>
                    <td>
                        {{ $contact->mutuelle }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Motif</strong></td>
                    <td>
                        {{ $contact->motif }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Nom du chirurgien-dentiste</strong></td>
                    <td>
                        {{ $contact->name_dentist }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Message</strong></td>
                    <td>
                        {!! nl2br($contact->message) !!}
                    </td>
                </tr>
                <tr>
                    <td><strong>Courrier ou ordonnance</strong></td>
                    <td>
                        @if (!empty($contact->file))
                            <a href="{{ route('office.contacts.show-file', [$contact->id, 'file']) }}">
                                Télécharger le fichier
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><strong>Panoramique dentaire</strong></td>
                    <td>
                        @if (!empty($contact->file_pano_dentaire))
                            <a href="{{ route('office.contacts.show-file', [$contact->id, 'file_pano_dentaire']) }}">
                                Télécharger le fichier
                            </a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </table>

        </div>
    </div>
@endsection

