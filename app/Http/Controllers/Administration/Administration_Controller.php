<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Administration\Model_Administration;

class Administration_Controller extends Controller
{
    private $modelStaff;

    function __construct(){
        $this->modelStaff = new Model_Administration();
    }

    function getStaffData(){
       $id = session()->get('id');
       $result = $this->modelStaff->getUserData($id);
       $json = array();
       foreach($result as $user){
           $temp = json_decode($user->toJSONPrivate(),true);
           array_push($json,$temp);
       }

       echo json_encode( $json);
    }


    function stopStaffUser(Request $request){
        $id = $request->getContent();
        $this->modelStaff->suspendreStaff($id);
    }
    function activeStaffUser(Request $request){
        $id = $request->getContent();
        $this->modelStaff->activeStaff($id);
    }



    function reiniPassword(Request $request){
        $id = $request->getContent();
        $this->modelStaff->reinitialisePasswordStaff($id);
    }

    function updateStaffUser(Request $request){
       $data = json_decode($request->getContent());
    
       $this->modelStaff->updateStaff($data->user_id,$data->firstName,$data->lastName,$data->email,$data->phone,$data->responsable,$data->role);
    }

    function addNewUser(Request $request){
        $data = json_decode($request->getContent());
        $this->modelStaff->addNewStaff($data->firstName,$data->lastName,$data->email,$data->phone,$data->responsable,$data->role);
    }

    function deleteStaffUser(Request $request){
        $id = $request->getContent();
        $this->modelStaff->deleteUser($id);
    }
}
