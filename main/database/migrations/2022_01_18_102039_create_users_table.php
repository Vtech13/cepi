<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ref_user_role_id')->constrained();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->text('information')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->string('token')->nullable();

            $table->foreignId('created_user_id')->nullable()->constrained('users');
            $table->foreignId('updated_user_id')->nullable()->constrained('users');

            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
