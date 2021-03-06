<?php

namespace App\Models\DAO\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_ProductionStock extends Model
{
   
    private  $store_id;
    private  $store_name;
    private  $product_id;
    private  $product_name;
    private  $quantity;
    private $price;


    function __construct($store_id,$store_name,$product_id,$product_name, $quantity, $price){
        $this->store_id=$store_id;
        $this->store_name=$store_name;
        $this->product_id=$product_id;
        $this->product_name=$product_name;
        $this->quantity=$quantity;
        $this->price=$price;
    }

    public function toJSONPRivate(){
        return json_encode([
            'store_id'=>$this->store_id,
            'magasin'=>$this->store_name,      
            'product_id'=>$this->product_id,
            'produit'=>$this->product_name,
            'quantity'=>$this->quantity,
            'price_id'=>$this->price
        ]);
    }
}
