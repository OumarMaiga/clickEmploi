<?php

namespace App\Exports;

use App\Models\User;
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
            $users = User::where('type', 'user')->get();
        } 
        return  $users->map(function($user){
            $secteurs = $user->secteurs()->get();
            $diplome = $user->diplome()->associate($user->dernier_diplome)->diplome;
            return [
                $user->nom,
                $user->prenom,
                $user->email,
                $diplome != null ? $diplome->libelle : "",
                $secteurs->implode('libelle', ', '),
            ];
        });
    }
    
    
    public function headings(): array
    {
        return [
            'nom',
            'prenom',
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
