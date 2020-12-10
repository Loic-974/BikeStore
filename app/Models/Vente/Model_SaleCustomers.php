<?php

namespace App\Models\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Vente\DAO_SaleCustomers;

class Model_SaleCustomers extends Model{

    function getCustomers($id_user){

        $idCustomerList = DB::select('SELECT Distinct customer_id FROM sales.orders where store_id = (SELECT store_id from sales.staffs where staff_id = ? )',[$id_user]);
        $customerList = array();    
        foreach($idCustomerList as $value){    
                $temp = DB::select('SELECT * FROM sales.customers where customer_id = ?',[$value->customer_id]);
                foreach($temp as $customer){
                    $info = new DAO_SaleCustomers($customer->customer_id,$customer->first_name,$customer->last_name,$customer->phone,$customer->email,$customer->street,$customer->city,$customer->state,$customer->zip_code);
                    array_push($customerList, $info);
                }
        }
        return $customerList;
    }
    
}