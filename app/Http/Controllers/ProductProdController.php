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

    function addProductProduction(Request $request){
        $result= $request->getContent();
        $temp = json_decode($result);

        $listProduct= $this->modelProduct->addProductProduction($temp->product_name,$temp->brandSelected,$temp->catSelected,$temp->model_year,$temp->list_price);
        $json=array();
        foreach($listProduct as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));    
        }

        echo json_encode($json);
    }
}
