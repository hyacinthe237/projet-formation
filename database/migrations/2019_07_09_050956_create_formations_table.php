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
          $table->bigInteger('number')->index();
          $table->string('title')->unique();
          $table->string('site')->nullable();
          $table->datetime('start_date')->nullable();
          $table->datetime('end_date')->nullable();
          $table->text('description')->nullable();
          $table->integer('qte_requis')->nullable();
          $table->string('duree')->nullable();
          $table->boolean('is_active')->default(false);
          $table->string('type')->nullable();
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
