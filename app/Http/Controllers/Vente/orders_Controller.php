<?php

namespace App\Http\Controllers\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vente\Model_SaleOrder;

class orders_Controller extends Controller
{

    private $modelOrders;

    function __construct(){

        $this->modelOrders = new Model_SaleOrder();
    }

    function getOrderData(){

        $id= session()->get('id');
        $result = $this->modelOrders->getSaleOrder($id);
    
        $json=array();
        foreach($result as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));
        }
     
        echo json_encode($json);
    }


    
}
