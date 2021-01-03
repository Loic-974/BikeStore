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

        $this->modelStock->insertNewStock(intval(htmlspecialchars($temp->selectedStore)),intval(htmlspecialchars($temp->selectedProduct)),intval(htmlspecialchars($temp->quantity)));
        
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
        
        $this->modelStock->updateProductStock(intval(htmlspecialchars($temp->store_id)),intval(htmlspecialchars($temp->product_id)),intval(htmlspecialchars($temp->quantity)));

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

        $this->modelStock->deleteProductStock(intval(htmlspecialchars($temp->sourceId)),intval(htmlspecialchars($temp->product_id)));
        $listStock = $this->modelStock->selectProductionStock();
        $json = array();
        foreach($listStock as $value){
            $temp=json_decode($value->toJSONPrivate(),true);
            array_push($json,$temp);
        }
        echo json_encode($json);

   }
}
