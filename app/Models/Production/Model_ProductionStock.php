<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Production\DAO_ProductionStock;

class Model_ProductionStock extends Model
{
   function selectProductionStock(){

        $result= DB::select('SELECT production.stocks.store_id, sales.stores.store_name, production.stocks.product_id, product_name, quantity, production.products.list_price
        From production.stocks
        LEFT JOIN sales.stores
        ON (production.stocks.store_id = sales.stores.store_id)
        LEFT JOIN production.products
        ON (production.stocks.product_id = production.products.product_id)');

        $stockList= array();

        foreach($result as $value){
          
                $temp= new DAO_ProductionStock($value->store_id,$value->store_name,$value->product_id,$value->product_name,$value->quantity,$value->list_price);
                array_push($stockList,$temp);
        }

        return $stockList;
    }

    function insertNewStock($storeName, $productName,$quantity){
        DB::insert('INSERT INTO production.stocks values ((SELECT store_id FROM sales.stores where store_name =?), 
        (SELECT product_id FROM production.products where product_name =?),
        ?)',[$storeName,$productName,$quantity]);
    }

    function updateProductStock($store_id,$product_id,$quantity){
        
        DB::update('UPDATE production.stocks set quantity=? where store_id=? AND product_id=?',[$quantity,$store_id,$product_id]);
    }

    function getStockItemByStore(){
       $result = DB::select('SELECT production.stocks.store_id, sales.stores.store_name, production.stocks.product_id, product_name, quantity,production.products.list_price
       From production.stocks
       LEFT JOIN sales.stores
       ON (production.stocks.store_id = sales.stores.store_id)
       LEFT JOIN production.products
       ON (production.stocks.product_id = production.products.product_id) where production.stocks.store_id = (SELECT store_id from sales.staffs where staff_id = ?) ',[session()->get('id')]);
       $stockList= array();

       foreach($result as $value){
               $temp= new DAO_ProductionStock($value->store_id,$value->store_name,$value->product_id,$value->product_name,$value->quantity,$value->list_price);
               array_push($stockList,$temp);
       }

       return $stockList;

    }

}
