<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;	

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    
        return new User([
           'name'     => $row[0],
           'email'    => $row[1], 
           'phone'    => $row[2],
           'address'  => $row[3],
           'password' => Hash::make($row[4]),
        ]);
    }
}
