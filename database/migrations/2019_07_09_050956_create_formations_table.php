<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('category_id')->nullable();
          $table->bigInteger('number')->index();
          $table->integer('session_id')->unsigned();
          $table->string('title')->unique();
          $table->text('description')->nullable();
          $table->boolean('is_active')->default(true);
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
    }
}
