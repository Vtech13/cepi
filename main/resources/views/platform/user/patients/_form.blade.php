
<div class="block-content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <x-form.input name="firstname" label="Prénom *"
                          bind="{{ $patient->firstname ?? null }}" required></x-form.input>
        </div>
        <div class="col-xs-12 col-sm-6">
            <x-form.input name="lastname" label="Nom *"
                          bind="{{ $patient->lastname ?? null }}" required></x-form.input>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <x-form.input name="phone" label="Telephone *"
                          bind="{{ $patient->phone ?? null }}" required></x-form.input>
        </div>
        <div class="col-xs-12 col-sm-6">
            <x-form.input name="date_of_birth" label="Date de naissance *"
                          placeholder="Entrez la date de naissance (24/01/1990)"
                          bind="{{ $patient->date_of_birth ?? null }}" required></x-form.input>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <x-form.input name="email" label="Adresse mail *"
                          bind="{{ $patient->email ?? null }}"></x-form.input>
        </div>
        <div class="col-xs-12 col-sm-6">
        <x-form.textarea name="information" label="Information" :bind="$patient->information ?? null"/>
        </div>
    </div>

    <x-form.select name="motif" label="Motif *" bind="{{ $patient->motif ?? null }}"
                   :options="$motifs" required/>
</div>
