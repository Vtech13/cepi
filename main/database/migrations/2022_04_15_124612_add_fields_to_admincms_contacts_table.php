<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAdmincmsContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admincms_contacts', function (Blueprint $table) {
            $table->string('date_of_birth')->nullable()->after('phone');
            $table->string('address', 255)->nullable()->after('date_of_birth');
            $table->string('motif')->nullable()->after('address');
            $table->string('name_dentist')->nullable()->after('motif');
            $table->string('file', 255)->nullable()->after('name_dentist');
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
            $table->dropColumn(['date_of_birth', 'address', 'motif', 'name_dentist', 'file']);
        });
    }
}
