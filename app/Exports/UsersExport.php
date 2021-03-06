<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Secteur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements WithHeadings, FromCollection
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        if($this->data != null){
            $users = $this->data;
        } else {
            $users = User::where('type', 'user')->orderBy('nom')->get();
        } 
        return  $users->map(function($user){
            $secteur_ids = $user->activites()->distinct()->pluck('secteur_id')->toArray();
            $secteurs = Secteur::whereIn('id', $secteur_ids)->get();
            $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
            return [
                $user->prenom,
                $user->nom,
                $user->email,
                $diplome != null ? $diplome->libelle : "",
                $secteurs->implode('libelle', ', '),
            ];
        });
    }
    
    
    public function headings(): array
    {
        return [
            'prenom',
            'nom',
            'email',
            'Niveau d\'étude',
            'Domaine d\'activité'
        ];
    }

    /*public function map($data): array
    {
        return [
            $data->nom,
            $data->email,
        ];
    }
    
    public function view(): View
    {
        return view('dashboards.users.table', [
            'users' => $this->data
        ]);
    }*/

}
