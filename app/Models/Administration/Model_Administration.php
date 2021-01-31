<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Administration\DAO_User;

class Model_Administration extends Model
{

    function getUserData($idStaff){

        $result = DB::select('SELECT * from sales.staffs where store_id = (SELECT store_id from sales.staffs where staff_id = ? )',[$idStaff]);
        $listUser = array();

        foreach ($result as $user){
            
            DD($user);
        }
    }

}
