<?php

namespace App\Http\Controllers\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vente\Model_Facture;

class facture_Controller extends Controller
{
    private $modelFacture;

    function __construct(){

        $this->modelFacture = new Model_Facture();
    }

    function getFactureData(Request $request){

        $orderId = $request->getContent();
        $result =json_decode($this->modelFacture->getFactureFromOrderId($orderId), true);
        foreach($result as $toto){
            foreach($toto as $test){
              
               $AllItem = preg_split('/([[{\]}])(?=([^\1]+|)":)/', $test);
               $product = array();
               foreach($AllItem as $item){
                   if(!empty($item) && $item!==','){
                       if(empty($item) || $item==','){
                        array_splice($AllItem,array_search($item,$AllItem));
                       }
                       if(str_contains($item,'item')){
                           array_splice($AllItem,array_search($item,$AllItem));
                           continue;
                       }
                       if(str_contains($item,'info')){ 
                        array_splice($AllItem,array_search($item,$AllItem));
                        continue;
                       }
                       array_push($product,$item);  
                    }                                      
                }  
                $subProduct = array();
                foreach($product as $ref){                
                    $temp = explode(',',$ref);
                    $object= array();
                    foreach($temp as $subRef){
                       $subTemp = explode(':',$subRef);
                       $object[$subTemp[0]]= $subTemp[1];                   
                    }  
                    array_push($subProduct,$object);               
                }   
                return json_encode($subProduct);         
            }        
        }
    }
}
