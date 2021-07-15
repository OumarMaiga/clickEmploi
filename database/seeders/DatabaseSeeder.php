<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use \App\Models\User;
use \App\Models\Diplome;
use \App\Models\Secteur;
use \App\Models\Activite;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'email' => 'admin@clickemploi.com',
           'telephone' => '20202020',
           'password' => Hash::make('password123'),
           'etat' => true,
           'type' => 'admin'
       ])->save();

       Diplome::create([
            'libelle' => 'Diplome d\'étude primaire',
            'slug' => 'diplome-detude-primaire',
            'annee_etude' => 9,
            'user_id' => 1,
        ])->save();

        Diplome::create([
            'libelle' => 'Baccalauréat',
            'slug' => 'baccalaureat',
            'annee_etude' => 12,
            'user_id' => 1,
        ])->save();

        Diplome::create([
            'libelle' => 'Licence',
            'slug' => 'licence',
            'annee_etude' => 15,
            'user_id' => 1,
        ])->save();

        Secteur::create([
            'libelle' => 'Informatique',
            'slug' => 'informatique',
            'user_id' => 1,
        ])->save();

        Secteur::create([
            'libelle' => 'Commerce',
            'slug' => 'commerce',
            'user_id' => 1,
        ])->save();

        Secteur::create([
            'libelle' => 'Administration',
            'slug' => 'administration',
            'user_id' => 1,
        ])->save();

        Secteur::create([
            'libelle' => 'Sante',
            'slug' => 'sante',
            'user_id' => 1,
        ])->save();

        Activite::create([
            'libelle' => 'Developpement',
            'slug' => 'developement',
            'user_id' => 1,
            'secteur_id' => 1,
        ])->save();

        Activite::create([
            'libelle' => 'Inforgraphie',
            'slug' => 'inforgraphie',
            'user_id' => 1,
            'secteur_id' => 1,
        ])->save();

        Activite::create([
            'libelle' => 'Système d\'information',
            'slug' => 'systeme-dinformation',
            'user_id' => 1,
            'secteur_id' => 1,
        ])->save();

        Activite::create([
            'libelle' => 'Reseau',
            'slug' => 'reseau',
            'user_id' => 1,
            'secteur_id' => 1,
        ])->save();

        Activite::create([
            'libelle' => 'Marketing',
            'slug' => 'marketing',
            'user_id' => 1,
            'secteur_id' => 2,
        ])->save();

        Activite::create([
            'libelle' => 'Commercial',
            'slug' => 'commercial',
            'user_id' => 1,
            'secteur_id' => 2,
        ])->save();

        Activite::create([
            'libelle' => 'Logistique',
            'slug' => 'logistique',
            'user_id' => 1,
            'secteur_id' => 2,
        ])->save();

        Activite::create([
            'libelle' => 'Compatabilité',
            'slug' => 'compatabilite',
            'user_id' => 1,
            'secteur_id' => 3,
        ])->save();

        Activite::create([
            'libelle' => 'Finance',
            'slug' => 'finance',
            'user_id' => 1,
            'secteur_id' => 3,
        ])->save();

        Activite::create([
            'libelle' => 'Droit',
            'slug' => 'droit',
            'user_id' => 1,
            'secteur_id' => 3,
        ])->save();

        Activite::create([
            'libelle' => 'Ressource humaine',
            'slug' => 'ressource-humaine',
            'user_id' => 1,
            'secteur_id' => 3,
        ])->save();

        Activite::create([
            'libelle' => 'Medicin',
            'slug' => 'medicin',
            'user_id' => 1,
            'secteur_id' => 4,
        ])->save();

        Activite::create([
            'libelle' => 'Aide soignant',
            'slug' => 'aide-soignant',
            'user_id' => 1,
            'secteur_id' => 4,
        ])->save();

        Activite::create([
            'libelle' => 'Infirmier',
            'slug' => 'infirmier',
            'user_id' => 1,
            'secteur_id' => 4,
        ])->save();

        Activite::create([
            'libelle' => 'Pharmacien',
            'slug' => 'pharmacien',
            'user_id' => 1,
            'secteur_id' => 4,
        ])->save();

        
    }


}
