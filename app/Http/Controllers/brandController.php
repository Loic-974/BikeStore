<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_ProductionBrands;

class brandController extends Controller
{

    private $modelBrand;

    function __construct(){
        $this->modelBrand=new Model_ProductionBrands();
    }

    function listBrand(){

    $listBrand = $this->modelBrand->selectBrandProduction();
    $json=array();

    foreach($listBrand as $value){
        array_push($json,json_decode($value->toJSONPrivate(),true));
    }

    $json=(json_encode($json));
    echo($json);

    }

    function addBrand(Request $request){
       
        $result = $request->getContent();
        $temp = json_decode($result);
       
            
            $listBrand=$this->modelBrand->addBrandProduction(htmlspecialchars($temp->brandName));
        
        $json=array();
        
        foreach($listBrand as $value){
            array_push($json,json_decode($value->toJSONPrivate(),true));
        }
    
        $json=(json_encode($json));
        echo($json);

    }

    function updateBrand(Request $request){

    $result = $request ->getContent();
    $data = json_decode($result);
    $listBrand = $this->modelBrand->updateBrandProduction(htmlspecialchars($data->brandName), htmlspecialchars($data->sourceId));

    $json = array();

    foreach($listBrand as $value){
        array_push($json, json_decode($value->toJSONPrivate(),true));
    }
    echo json_encode($json);
    }

    function deleteBrand(Request $request){

        $result = $request->getContent();
        $data = json_decode($result);
      
         $listBrand = $this->modelBrand->deleteBrandProduction(htmlspecialchars($data->brand_id));
         $json = array();

         foreach($listBrand as $value){

            array_push($json, json_decode($value->toJSONPrivate(),true));
         }

        echo json_encode($json);
    }

}
