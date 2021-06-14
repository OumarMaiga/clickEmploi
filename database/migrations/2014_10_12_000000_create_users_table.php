<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->dateTime('date_naissance')->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->text('adresse')->nullable();
            $table->string('dernier_diplome')->nullable();
            $table->string('experience_professionnel')->nullable();
            $table->string('type')->nullable();
            $table->boolean('etat')->default(true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
