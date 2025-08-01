<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObjetGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Cette migration n'est plus nécessaire car le champ 'objet' est déjà créé dans la migration de création de la table.
        // Vous pouvez supprimer ce fichier après avoir vérifié l'ordre des migrations.
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
