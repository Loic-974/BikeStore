<?php

namespace App\Models\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Vente\DAO_SaleOrders;

class Model_SaleOrder extends Model
{
  
    function getSaleOrder($idStaff){

        $listOrder = DB::select('SELECT * from sales.orders where store_id = (SELECT store_id from sales.staffs where staff_id = ? )',[$idStaff]);
        $list = array();
    
    
        foreach($listOrder as $value){
            $nameClient = DB::select('SELECT last_name, first_name from sales.customers where customer_id= ?',[$value->customer_id]);
            foreach($nameClient as $info){
                $lastName=$info->last_name;
                $firstName=$info->first_name;
            }
            $temp = new DAO_SaleOrders($value->order_id,$value->customer_id,$lastName,$firstName,$value->order_status,$value->order_date,$value->required_date,$value->shipped_date,$value->store_id,$value->staff_id);
            array_push($list, $temp);
        }
      
        return $list;
    }

}
