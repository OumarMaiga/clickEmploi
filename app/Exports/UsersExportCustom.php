<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExportCustom implements FromView
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('dashboards.users.table', [
            'users' => $this->data
        ]);
    }
}