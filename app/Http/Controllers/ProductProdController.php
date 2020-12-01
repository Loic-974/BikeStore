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

        $listProduct= $this->modelProduct->addProductProduction(htmlspecialchars($temp->product_name),htmlspecialchars($temp->brandSelected),htmlspecialchars($temp->catSelected),htmlspecialchars($temp->model_year),htmlspecialchars($temp->list_price));
        $json=array();
        foreach($listProduct as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));    
        }

        echo json_encode($json);
    }

    function updateProductProduction(Request $request){

        $result = $request->getContent();
        $temp=json_decode($result);

        $this->modelProduct->updateProductProduction(htmlspecialchars($temp->product_name),htmlspecialchars($temp->model_year),htmlspecialchars($temp->list_price),htmlspecialchars($temp->sourceId));

        $listProduct = $this->modelProduct->getProductionProduct();
        $json = array();

        foreach( $listProduct as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));

        }

        echo json_encode($json);
    }

    function deleteProductProduction(Request $request){

        $result = $request->getContent();
        $temp = json_decode($result);
        $this->modelProduct->deleteProductProduction(htmlspecialchars($temp->product_id));
        $listProduct = $this->modelProduct->getProductionProduct();
        $json = array();

        foreach( $listProduct as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));

        }

        echo json_encode($json);
    }
}
