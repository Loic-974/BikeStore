<?php

namespace App\Http\Controllers;
use App\Models\staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updatePassword extends Controller
{
    public function updatePassword(Request $request){
        
        $staffData = staff::all();
        $password = $request->{'newPassword'};
        $confirmPassword = $request->{'confirmPassword'};
        $idUser = session('id');
        $result= DB::select('select password from sales.staffs where staff_id=?',[$idUser]);
      

        if(isset($password)){

            if((!empty($password)) && ($password != $result)){
                $password=password_hash($password);
                $new= DB::update('update sales.staffs set first_connect = 1 where staff_id=?',[$idUser]);
                $newpwd = DB::update('update sales.staffs set password=? where staff_id=?',[$password,$idUser]);

                return view('accueil', ['firstConnect'=>1]);

            }else{
                return view('accueil', ['firstConnect'=>0]);
            }
        }

         return view('accueil');
    }

    public function getOldPassword(){
        $idUser = session('id');
        $staffData = staff::all();
        $result= DB::select('select password from sales.staffs where staff_id=?',[$idUser]);
        return $result;
    }
}
