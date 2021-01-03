<?php

namespace App\Http\Controllers\Vente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vente\Model_SaleCustomers;

class customers_Controller extends Controller
{
    private $modelCustomers;

    function __construct(){

        $this->modelCustomers=new Model_SaleCustomers();
    }

    function getCustomers(){
        $id = session()->get('id');
        $temp = $this->modelCustomers-> getCustomers($id);
        $json = array();
        foreach($temp as $value){

            array_push($json, json_decode($value->toJSONPrivate(),true));
        }
        
        $json = json_encode($json);
        echo $json;

    }


    function updateCustomer(){

        
    }

}
