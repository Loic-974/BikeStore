<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\DAO_ProductionStock;

class Model_ProductionStock extends Model
{
   function selectProductionStock(){

        $result= DB::select('SELECT production.stocks.store_id, sales.stores.store_name, production.stocks.product_id, product_name, quantity
        From production.stocks
        LEFT JOIN sales.stores
        ON (production.stocks.store_id = sales.stores.store_id)
        LEFT JOIN production.products
        ON (production.stocks.product_id = production.products.product_id)');

        $stockList= array();

        foreach($result as $value){
                $temp= new DAO_ProductionStock($value->store_id,$value->store_name,$value->product_id,$value->product_name,$value->quantity);
                array_push($stockList,$temp);
        }

        return $stockList;
    }

}
