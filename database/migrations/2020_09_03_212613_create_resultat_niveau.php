<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultatNiveau extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultat_niveau', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('niveau_id');
            $table->unsignedBigInteger('etudiant_id');
            $table->enum('is_succeed', ['0', '1'])->default('0');
            $table->foreign('etudiant_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('niveau_id')->references('id')->on('niveaux')->onDelete('cascade');
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
        Schema::dropIfExists('resultat_niveau');
    }
}
