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
            $table->integer('temps')->nullable();
            $table->float('pourcentage', 8, 2);
            $table->enum('is_done', ['0', '1'])->default('0');
            $table->enum('is_succeeded', ['0', '1'])->default('0');
            $table->timestamps();
            $table->foreign('qcm_id')->references('id')->on('qcms')->onDelete('cascade');
            $table->foreign('etudiant_id')->references('id')->on('users')->onDelete('cascade');
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
