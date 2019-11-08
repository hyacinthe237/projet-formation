<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhaseIdToFormationEtudiants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formation_etudiants', function (Blueprint $table) {
           $table->string('phases')->nullable()->after('commune_formation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('formation_etudiants', function (Blueprint $table) {
            $table->dropColumn('phases');
        });
    }
}
