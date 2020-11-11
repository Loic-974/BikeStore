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

}
