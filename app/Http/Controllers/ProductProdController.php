<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_ProductionProduct;

class ProductProdController extends Controller
{
    
    private $modelProduct;

    function __construct(){
        $this->modelProduct= new Model_ProductionProduct();
    }

    function getListProduct(){
        $list= $this->modelProduct->getProductionProduct();
        $json=array();
        foreach($list as $value){          
            array_push($json,json_decode($value->toJSONPrivate(),true));
        }
   
       echo json_encode($json);
    }


}
