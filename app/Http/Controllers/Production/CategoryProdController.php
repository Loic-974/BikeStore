<?php

namespace App\Http\Controllers\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Production\Model_ProductionCat;

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

    function addCategoryProduction(Request $request){

        $result = $request->getContent();
        $category = json_decode($result);

        $listCat = $this->modelCat->addCategory(htmlspecialchars($category->category_name));

        $json = array();

        foreach($listCat as $value){

            array_push($json,json_decode($value->toJSONPRivate(),true));
        }
        echo json_encode($json);
    }

    function updateCategoryProduction(Request $request){

        $result = $request->getContent();
        $category = json_decode($result);
      
        $listCat = $this->modelCat->updateCategory(htmlspecialchars($category->categoryName),htmlspecialchars($category->sourceId));

        $json = array();

        foreach($listCat as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));
        }
        echo json_encode($json);
    }

    function deleteCategoryProduction( Request $request){

        $result = $request -> getContent();
        $category = json_decode($result);
      
        $listCat = $this->modelCat->deleteCategory(htmlspecialchars($category->category_id));

        $json = array();

        foreach($listCat as $value){
            array_push($json, json_decode($value->toJSONPrivate(),true));
        }
        echo json_encode($json);
    }
}
