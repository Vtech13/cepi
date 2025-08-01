<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmincmsAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admincms_attachments', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['img', 'mov', 'pdf'])->default('img');
            $table->string('attachable_type');
            $table->unsignedBigInteger('attachable_id');
            $table->string('name');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('created_user_id');
            $table->unsignedBigInteger('updated_user_id')->nullable();

            $table->foreign('created_user_id', 'attachment_created_user')->references('id')->on('users');
            $table->foreign('updated_user_id', 'attachment_updated_user')->references('id')->on('users');

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
        Schema::dropIfExists('admincms_attachments');
    }
}
