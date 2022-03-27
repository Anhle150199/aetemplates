<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ae_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('post_title', 150);
            $table->text('post_excerpt');
            $table->longText('post_content');
            $table->enum('post_type', ['Public', 'Drafts', 'Deleted' ])->default('drafts');
            $table->string('post_slug', 150);
            $table->string('post_thumbnail');
            $table->integer('post_views');
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
        Schema::dropIfExists('ae_posts');
    }
}
