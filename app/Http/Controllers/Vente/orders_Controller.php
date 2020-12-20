<?php

namespace App\Http\Controllers\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vente\Model_SaleOrder;
use App\Models\Model_ProductionStock;

class orders_Controller extends Controller
{

    private $modelOrders;
    private $modelStock;

    function __construct(){

        $this->modelOrders = new Model_SaleOrder();
        $this->modelStock = new Model_ProductionStock();
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

    
    function getStockOrder(){

        $result = $this->modelStock->getStockItemByStore();
        $json=array();
        foreach($result as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));
        }
     
        echo json_encode($json);
    }
    
}
