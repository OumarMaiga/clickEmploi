<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportuniteSecteurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunite_secteur', function (Blueprint $table) {
            $table->foreignId('opportunite_id')->reference('id')->on('opportunites');
            $table->foreignId('secteur_id')->reference('id')->on('secteurs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunite_secteur');
    }
}
