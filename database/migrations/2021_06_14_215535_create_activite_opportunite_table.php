<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiviteOpportuniteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activite_opportunite', function (Blueprint $table) {
            $table->foreignId('activite_id')->reference('id')->on('activites');
            $table->foreignId('opportunite_id')->reference('id')->on('opportunites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opportunite_activite');
    }
}
