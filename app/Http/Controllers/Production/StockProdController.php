<?php

namespace App\Http\Controllers\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Production\Model_ProductionStock;

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

    function insertNewStock(request $request){

        $result= $request->getContent();
        $temp = json_decode($result);

        $this->modelStock->insertNewStock(htmlspecialchars($temp->selectedStore),htmlspecialchars($temp->selectedProduct),htmlspecialchars($temp->quantity));
        
        $listStock = $this->modelStock->selectProductionStock();
        $json = array();
        foreach($listStock as $value){
            $temp=json_decode($value->toJSONPrivate(),true);
            array_push($json,$temp);
        }
        echo json_encode($json);

    }

   function updateProductStock (request $request){

        $result= $request->getContent();
        $temp = json_decode($result);

        $this->modelStock->updateProductStock(htmlspecialchars($temp->sourceId),htmlspecialchars($temp->product_id),htmlspecialchars($temp->quantity));

        $listStock = $this->modelStock->selectProductionStock();
        $json = array();
        foreach($listStock as $value){
            $temp=json_decode($value->toJSONPrivate(),true);
            array_push($json,$temp);
        }
        echo json_encode($json);

   }

   function deleteProductStock  (Request $request){

        $result = $request->getContent();
        $temp = json_decode($result);

        $this->modelStock->deleteProductStock(htmlspecialchars($temp->sourceId),htmlspecialchars($temp->product_id));
        $listStock = $this->modelStock->selectProductionStock();
        $json = array();
        foreach($listStock as $value){
            $temp=json_decode($value->toJSONPrivate(),true);
            array_push($json,$temp);
        }
        echo json_encode($json);

   }
}
