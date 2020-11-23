<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\DAO_ProductionProduct;

class Model_ProductionProduct extends Model
{
    function getProductionProduct(){

        $product=DB::select('SELECT * from production.products');
        $products=array();

        foreach($product as $value){

            $prod = new DAO_ProductionProduct($value->product_id,$value->product_name,$value->brand_id,$value->category_id,$value->model_year,$value->list_price);
            array_push($products,$prod);
        }
        return $products;
    }

    function addProductProduction($productName,$brandId,$catId,$modelYear,$price){

        $product=DB::insert('INSERT INTO production.products values (?,?,?,?,?)',[$productName,$brandId,$catId,$modelYear,$price]);
        $listProd = DB::select('SELECT * from production.products');
        $products=array();

        foreach($listProd as $value){

            $prod = new DAO_ProductionProduct($value->product_id,$value->product_name,$value->brand_id,$value->category_id,$value->model_year,$value->list_price);
            array_push($products,$prod);
        }
        return $products;

    }

}
