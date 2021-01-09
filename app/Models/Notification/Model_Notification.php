<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Notification\DAO_Notification;

class Model_Notification extends Model
{
  

    function getNotification(){
      $request =DB::select('SELECT * FROM sales.notifications WHERE store_id = (Select store_id from sales.staffs where staff_id = ?) and status = 0',[session()->get('id')]);
      $array=array();

      foreach($request as $value){
          $temp = new DAO_Notification($value->notification_id,$value->type,$value->date,$value->legende,$value->order_id,$value->store_id,$value->status);
          array_push($array,$temp);
      }

      return $array;
    }


}
