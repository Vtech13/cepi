<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToAdmincmsContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admincms_contacts', function (Blueprint $table) {
            $table->string('postal_code', 20)->nullable()->after('address');
            $table->string('city')->nullable()->after('postal_code');
            $table->string('number_security_social')->nullable()->after('city');
            $table->string('mutuelle')->nullable()->after('number_security_social');
            $table->string('file_pano_dentaire')->nullable()->after('file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admincms_contacts', function (Blueprint $table) {
            $table->dropColumn(['postal_code', 'city', 'number_security_social', 'mutuelle', 'file_pano_dentaire']);
        });
    }
}
