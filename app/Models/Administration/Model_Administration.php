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
        
        $ManagerTemp = DB::select('SELECT last_name,first_name from sales.staffs where staff_id=?',[$user->manager_id]);   
   
        
                foreach($ManagerTemp as $info){    
       
                    $user->managerLastName=$info->last_name;
                    $user->managerFirstName=$info->first_name;
                }    
                
                if( empty($ManagerTemp)){
                    $user->managerLastName='Pas de Superieur';
                    $user->managerFirstName='Pas de Superieur';
                };
              
         $temp = new DAO_User($user->staff_id,$user->first_name,$user->last_name,$user->email,$user->phone,$user->active,$user->store_id,$user->manager_id,$user->managerFirstName,$user->managerLastName,$user->password,$user->first_connect,$user->role_user);
         array_push($listUser,$temp);
        }
        return $listUser;
    }

    function suspendreStaff($id){

        DB::update('UPDATE sales.staffs set active = 0 where staff_id = ?',[$id]);

    }

    function activeStaff($id){
        DB::update('UPDATE sales.staffs set active =1 where staff_id = ?',[$id]);
    }

    function reinitialisePasswordStaff($id){
        DB::update('UPDATE sales.staffs set password=? , first_connect = 0 where staff_id = ?',['azerty',$id]);
    }

    function updateStaff($id,$firstName,$lastName,$email,$phone,$manager_id,$roleUser){
        DB::update('UPDATE sales.staffs set first_name=?,last_Name=?,email=?,phone=?,manager_id=?,role_user=? where staff_id = ?',[$firstName,$lastName,$email,$phone,$manager_id,$roleUser,$id]);
    }

    function addNewStaff($firstName,$lastName,$email,$phone,$manager_id,$roleUser){
        $store_id = DB::select('SELECT store_id from sales.staffs where staff_id = ?',[session()->get('id')]);
      foreach($store_id as $idStore){;
          $tempIdStore = $idStore->store_id;
      }
        DB::insert('INSERT INTO sales.staffs (first_name,last_name,email,phone,active,store_id,manager_id,password,first_connect,role_user) VALUES(?,?,?,?,1,?,?,?,0,?)',[$firstName,$lastName,$email,$phone,$tempIdStore,$manager_id,'azerty',$roleUser]);
    }

}
