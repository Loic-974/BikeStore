<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_ProductionCat;

class CategoryProdController extends Controller
{
    private $modelCat;

    function __construct(){

        $this->modelCat=new Model_ProductionCat();

    }

    function getListCategories(){

        $listCat = $this->modelCat->getCategories();
        $json=array();
        foreach($listCat as $value){

            array_push($json, json_decode($value->toJSONPrivate(),true));

        }

       return json_encode($json);

    }
}