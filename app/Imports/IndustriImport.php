<?php

namespace App\Imports;

use App\Industri;
use Maatwebsite\Excel\Concerns\ToModel;

class IndustriImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Industri([
            [
                'name'     => $row[0],
                'email'    => $row[1], 
                'password' => $row[2],
             ]
        ]);
    }
}
