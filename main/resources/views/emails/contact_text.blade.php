Bonjour {{ config('app.name') }}

Félicitations !

Vous avez reçu une demande de contact.


Date: {{ date('d/m/Y H:i:s') }}

Nom: {{ $data['lastname'] }}

Prénom: {{ $data['firstname'] }}

Email: {{ $data['email'] }}

Téléphone: {{ $data['phone'] }}

Date de naissance: {{ $data['date_of_birth'] }}

Adresse: {{ $data['address'] }}

Code postal: {{ $data['postal_code'] }}

Ville: {{ $data['city'] }}

Numéro de sécurité social: {{ $data['number_security_social'] }}

Mutuelle: {{ $data['mutuelle'] }}

Motif: {{ $data['motif'] }}

Nom du dentiste: {{ $data['name_dentist'] }}

Message: {!! nl2br($data['message']) !!}
