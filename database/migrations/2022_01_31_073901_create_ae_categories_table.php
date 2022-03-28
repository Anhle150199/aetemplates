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
            $table->string('cate_name',100);
            $table->string('cate_slug',100);
            // $table->integer('cate_level')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('children_count')->default(0);
            $table->enum('cate_type', ['public', 'deleted'])->default('public');
            $table->integer('posts_count')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

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
