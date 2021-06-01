<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('poste')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('user_id');
            $table->text('content')->nullable();
            $table->foreignId('entreprise_id')->nullable();
            $table->string('lieu')->nullable();
            $table->string('duree')->nullable();
            $table->string('niveau')->nullable();
            $table->string('montant')->nullable();
            $table->string('type_contrat')->nullable();
            $table->string('annee_experience')->nullable();
            $table->string('prerequis')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('opportunites');
    }
}
