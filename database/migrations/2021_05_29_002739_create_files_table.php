<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('file_path');
            $table->string('type');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('postule_id')->nullable();
            $table->foreignId('opportunite_id')->nullable();
            $table->foreignId('entreprise_id')->nullable();
            $table->integer('profil_id')->nullable();
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
        Schema::dropIfExists('files');
    }
}
