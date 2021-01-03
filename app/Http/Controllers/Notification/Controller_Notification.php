<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification\Model_Notification;

class Controller_Notification extends Controller
{
    
    private $modelNotif;

    function __construct(){
        $this->modelNotif = new Model_Notification();
    }
    
    function getNotification(){

        $result = $this->modelNotif->getNotification();

        if(!Empty($result)){
         

            $json=array();

                foreach($result as $value){
                    $notif = json_decode($value->JSONToPrivate(), true);
                    array_push($json,$notif);
                }

            echo json_encode($json);
        }
    }

}
