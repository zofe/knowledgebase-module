<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('short_text')->nullable();
            $table->longText('full_text')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('views_count')->default(0);
            $table->string('slug')->unique();
            $table->tinyInteger('is_internal')->default(0);
            $table->string('attachment')->nullable();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
