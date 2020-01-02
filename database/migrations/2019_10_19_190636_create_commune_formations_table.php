<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommuneFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commune_formations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id');
            $table->integer('formation_id');
            $table->integer('commune_id');
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->string('duree')->nullable();
            $table->integer('qte_requis')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('commune_formations');
    }
}
