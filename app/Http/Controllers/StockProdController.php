<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_ProductionStock;

class StockProdController extends Controller
{
    private $modelStock;

    function __construct(){  
        $this->modelStock= new Model_ProductionStock();
    }

    function getListStock(){
        $result=$this->modelStock->selectProductionStock();
        $json = array();
        foreach($result as $value){
            $temp=json_decode($value->toJSONPrivate(),true);
            array_push($json,$temp);
        }
        echo json_encode($json);
    }
}
