<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('residence_id')->nullable();
          $table->bigInteger('number')->index();
          $table->string('firstname');
          $table->string('lastname')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->unique();
          $table->string('sex')->nullable();
          $table->string('dob')->nullable();
          $table->integer('structure_id')->nullable();
          $table->integer('fonction_id')->nullable();
          $table->text('desc_fonction')->nullable();
          $table->text('form_souhaitee')->nullable();
          $table->text('form_initiale')->nullable();
          $table->text('diplome_elev')->nullable();
          $table->text('form_compl')->nullable();
          $table->string('an_exp')->nullable();
          $table->boolean('is_active')->default(true);
          $table->string('signature_url')->nullable();
          $table->string('photo')->nullable();
          $table->string('thumbnail')->nullable();
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
        Schema::dropIfExists('etudiants');
    }
}
