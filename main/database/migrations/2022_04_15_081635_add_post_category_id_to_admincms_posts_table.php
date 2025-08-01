<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostCategoryIdToAdmincmsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admincms_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('post_category_id')->nullable()->after('status');

            $table->foreign('post_category_id', 'post_category_id')->references('id')->on('admincms_post_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admincms_posts', function (Blueprint $table) {
            $table->dropColumn('post_category_id');
            $table->dropForeign('post_category_id');
        });
    }
}
