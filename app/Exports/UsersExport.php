<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class UsersExport implements FromCollection, WithMapping, WithHeadings, FromArray
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  User::where('type', 'user')->get();
    }
    
    public function map($user): array
    {
        return [
            $user->nom,
            $user->email,
        ];
    }
    
    public function headings(): array
    {
        return [
            'nom',
            'email',
        ];
    }

    public function array(): array
    {
        return [
            [1, 2, 3],
            [4, 5, 6]
        ];
    }

}
