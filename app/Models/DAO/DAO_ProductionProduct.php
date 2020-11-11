<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_ProductionProduct extends Model
{
    private $product_id=0;
    private $product_name=null;
    private $brand_id=0;
    private $category_id=0;
    private $model_year= 0;
    private $list_price= 0;

   function __construct($product_id,$product_name,$brand_id,$category_id,$model_year,$list_price){

    $this->product_id=$product_id;
    $this->product_name=$product_name;
    $this->brand_id=$brand_id;
    $this->category_id=$category_id;
    $this->model_year=$model_year;
    $this->list_price=$list_price;

   }

   public function toJSONPrivate(){

        return json_encode([
                "product_id"=>$this->product_id,
                "product_name"=>$this->product_name,
                "brand_id"=>$this->brand_id,
                "category_id"=>$this->category_id,
                "model_year"=>$this->model_year,
                "list_price"=>$this->list_price
            ]);
   }

}
