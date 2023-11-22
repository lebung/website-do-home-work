<?php

namespace App\Exports;

use App\Models\UserClassroom;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportFileUserClass implements FromCollection
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return UserClassroom::all();
        return $this->user;
    }
}
