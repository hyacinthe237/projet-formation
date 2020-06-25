<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBesoinFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('besoin_formations', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('number')->index();
            $table->integer('commune_id')->unsigned();
            $table->integer('cible_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('dipl_elev')->nullable();
            $table->text('autre_dipl')->nullable();
            $table->date('dob')->nullable();
            $table->date('date_cud')->nullable();
            $table->text('direction_service')->nullable();
            $table->text('ancien_poste')->nullable();
            $table->text('duree_ancien_poste')->nullable();
            $table->text('nouveau_poste')->nullable();
            $table->text('duree_nouveau_poste')->nullable();
            $table->text('question_1')->nullable();
            $table->text('question_2')->nullable();
            $table->text('question_3')->nullable();
            $table->text('question_4')->nullable();
            $table->text('question_5')->nullable();
            $table->text('question_6')->nullable();
            $table->text('question_7')->nullable();
            $table->text('question_8')->nullable();
            $table->text('question_9')->nullable();
            $table->text('question_10')->nullable();
            $table->text('question_11')->nullable();
            $table->text('question_12')->nullable();
            $table->text('question_13')->nullable();
            $table->text('question_14')->nullable();
            $table->boolean('is_validate')->default(true);
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
        Schema::dropIfExists('besoin_formations');
    }
}
