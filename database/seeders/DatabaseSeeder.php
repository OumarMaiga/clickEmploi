<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::create([
            'email' => 'hasseye@gmail.com',
            'telephone' => '71316544',
            'password' => Hash::make('hasseyemg'),
        ])->save();
        
        \App\Models\Opportunite::create([
            'title' => 'Titre',
            'slug' => 'titre',
            'content' => 'Somethin long text should be written here!!!',
            'type' => 'emploi',
            'user_id' => '1',
        ])->save();
    }
}
