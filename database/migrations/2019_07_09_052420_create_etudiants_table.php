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
          $table->integer('location_id')->nullable();
          $table->bigInteger('number')->index();
          $table->string('firstname');
          $table->string('lastname')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->unique();
          $table->string('sex')->nullable();
          $table->string('dob')->nullable();
          $table->string('structure')->nullable();
          $table->string('fonction')->nullable();
          $table->text('desc_fonction')->nullable();
          $table->text('form_souhaitee')->nullable();
          $table->text('form_initiale')->nullable();
          $table->text('diplome_elev')->nullable();
          $table->text('form_compl')->nullable();
          $table->string('an_exp')->nullable();
          $table->boolean('is_active')->default(true);
          $table->string('signature_url')->nullable();
          $table->string('photo')->nullable();
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
