<?php

namespace App\Imports;

use App\Perusahaan;
use Maatwebsite\Excel\Concerns\ToModel;

class PerusahaanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Perusahaan([
            [
                'name'     => $row[0],
                'email'    => $row[1], 
                'password' => $row[2],
             ]
        ]);
    }
}
