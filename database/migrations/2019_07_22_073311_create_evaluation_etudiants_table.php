<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_etudiants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('formation_etudiant_id')->nullable();
            $table->date('date_of');
            $table->string('type')->default('Evaluation Quotidienne');
            $table->text('criteres');
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
        Schema::dropIfExists('evaluation_etudiants');
    }
}
