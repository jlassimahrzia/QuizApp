<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->string('choix1');
            $table->string('choix2');
            $table->string('choix3');
            $table->string('choix4')->nullable();
            $table->enum('reponse1', ['vrai', 'faux']);
            $table->enum('reponse2', ['vrai', 'faux']);
            $table->enum('reponse3', ['vrai', 'faux']);
            $table->enum('reponse4', ['vrai', 'faux'])->nullable();
            $table->float('note', 8, 2);
            $table->unsignedBigInteger('qcm_id');
            $table->timestamps();
            $table->foreign('qcm_id')->references('id')->on('qcms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
