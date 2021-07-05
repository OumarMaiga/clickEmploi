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
           'email' => 'admin@clickemploi.com',
           'telephone' => '20202020',
           'password' => Hash::make('password123'),
           'etat' => true,
           'type' => 'admin'
       ])->save();

       \App\Models\Diplome::create([
          'libelle' => 'Diplome d\'étude primaire',
          'slug' => 'diplome-detude-primaire',
          'annee_etude' => 9,
          'user_id' => 1,
      ])->save();

       \App\Models\Diplome::create([
          'libelle' => 'Baccalauréat',
          'slug' => 'baccalaureat',
          'annee_etude' => 12,
          'user_id' => 1,
      ])->save();

      \App\Models\Diplome::create([
         'libelle' => 'Licence',
         'slug' => 'licence',
         'annee_etude' => 15,
         'user_id' => 1,
     ])->save();

     \App\Models\Secteur::create([
        'libelle' => 'Informatique',
        'slug' => 'informatique',
        'user_id' => 1,
    ])->save();

    \App\Models\Secteur::create([
       'libelle' => 'Commerce',
       'slug' => 'commerce',
       'user_id' => 1,
   ])->save();

   \App\Models\Secteur::create([
      'libelle' => 'Administration',
      'slug' => 'administration',
      'user_id' => 1,
  ])->save();

    \App\Models\Secteur::create([
       'libelle' => 'Sante',
       'slug' => 'sante',
       'user_id' => 1,
   ])->save();
        
    }
}
