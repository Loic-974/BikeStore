<?php

namespace App\Models\DAO\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_SaleOrderItems extends Model{


    private $order_id;
    private $item_id;
    private $product_id;
    private $quantity;
    private $list_price;
    private $discount;

    function __construct($order_id,$item_id,$product_id,$quantity,$list_price,$discount){

        $this->order_id=$order_id;
        $this->item_id=$item_id;
        $this->product_id=$product_id;
        $this->quantity=$quantity;
        $this->list_price=$list_price;
        $this->discount=$discount;
    }

    function toJSONPrivate(){

        json_encode([
            'order_id'=> $this->order_id,
            'item_id'=>$this->item_id,
            'product_id'=>$this->product_id,
            'quantite'=> $this->quantity,
            'price'=>$this->list_price,
            'discount'=>$this->discount
        ]);
    }
}