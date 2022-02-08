<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ae_categories', function (Blueprint $table) {
            $table->id();
            $table->string('cate_name',50);
            $table->integer('parrent_id')->default(0);
            $table->enum('cate_type', ['public', 'deleted'])->default('public');
            $table->integer('posts_count')->default(0);
            $table->string('cate_slug',50);
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
        Schema::dropIfExists('ae_categories');
    }
}
