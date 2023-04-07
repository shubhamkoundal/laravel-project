<?php
namespace App\Http\Controllers;
namespace App\Exports;

use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}