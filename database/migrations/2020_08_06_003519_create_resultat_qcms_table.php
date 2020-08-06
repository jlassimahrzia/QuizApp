<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultatQcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultat_qcms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('qcm_id');
            $table->unsignedBigInteger('etudiant_id');
            $table->float('score', 8, 2);
            $table->integer('temps');
            $table->enum('is_done', ['1', '2', '3','4']);
            $table->enum('is_succeeded', ['1', '2', '3','4']);
            $table->timestamps();
            $table->foreign('qcm_id')->references('id')->on('qcms');
            $table->foreign('etudiant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultat_qcms');
    }
}
