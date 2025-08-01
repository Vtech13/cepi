<h2 style="text-align:center;">Demande de Contact</h2>
<p style="font-size:16px;">Bonjour {{ config('app.name') }}</p>
<p style="font-size:16px;">Félicitations !</p>
<p style="font-size:16px;">Vous avez reçu une demande de contact.</p>

<table rules="all" style="border-color: #666;" cellpadding="10">
    <tr>
        <td><strong>Date</strong></td>
        <td>
            {{ date('d/m/Y H:i:s') }}
        </td>
    </tr>
    <tr>
        <td><strong>Nom</strong></td>
        <td>
            {{ $data['lastname'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Prénom</strong></td>
        <td>
            {{ $data['firstname'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>
            <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a>
        </td>
    </tr>
    <tr>
        <td><strong>Téléphone</strong></td>
        <td>
            {{ $data['phone'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Date de naissance</strong></td>
        <td>
            {{ $data['date_of_birth'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Adresse</strong></td>
        <td>
            {{ $data['address'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Code postal</strong></td>
        <td>
            {{ $data['postal_code'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Ville</strong></td>
        <td>
            {{ $data['city'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Numéro de sécurité social</strong></td>
        <td>
            {{ $data['number_security_social'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Mutuelle</strong></td>
        <td>
            {{ $data['mutuelle'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Motif</strong></td>
        <td>
            {{ $data['motif'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Nom du chirurgien-dentiste</strong></td>
        <td>
            {{ $data['name_dentist'] }}
        </td>
    </tr>
    <tr>
        <td><strong>Message</strong></td>
        <td>
            {!! nl2br($data['message']) !!}
        </td>
    </tr>
</table>
