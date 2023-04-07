<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\ExcelServiceProvider;


class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('name', 'email', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Registration Date',
        ];
    }
} 
