<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('number')->index();
            $table->integer('etudiant_id')->unsigned();
            $table->integer('commune_formation_id')->unsigned();
            $table->boolean('is_validate')->default(true);
            $table->enum('contenu', ['entierement', 'moyennement', 'faiblement', 'pas du tout'])->nullable();
            $table->text('desc_contenu')->nullable();
            $table->enum('mise_1', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('mise_2', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('mise_3', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('mise_4', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('mise_5', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->text('mise_6')->nullable();
            $table->enum('utilite_1', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('utilite_2', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('statisfaction_1', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('statisfaction_2', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('statisfaction_3', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->enum('statisfaction_4', ['insuffisant', 'passable', 'assez-bien', 'bien', 'tres-bien'])->nullable();
            $table->text('amelioration')->nullable();
            $table->integer('avant_formation')->nullable();
            $table->integer('apres_formation')->nullable();
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
        Schema::dropIfExists('evaluations');
    }
}
