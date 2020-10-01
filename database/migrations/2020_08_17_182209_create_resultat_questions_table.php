<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultatQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultat_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('etudiant_id');
            $table->enum('reponse1', ['vrai', 'faux'])->default('faux');
            $table->enum('reponse2', ['vrai', 'faux'])->default('faux');
            $table->enum('reponse3', ['vrai', 'faux'])->default('faux');
            $table->enum('reponse4', ['vrai', 'faux'])->default('faux')->nullable();
            $table->float('score', 8, 2)->nullable();
            $table->enum('is_correct', ['0', '1'])->default('0')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('etudiant_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('resultat_questions');
    }
}
