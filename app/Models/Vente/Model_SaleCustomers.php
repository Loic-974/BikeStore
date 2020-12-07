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

            array_push($customerList, DB::select('SELECT * FROM sales.customers where customer_id = ?',[$value]));
        }

        return $customerList;
    }
    
}