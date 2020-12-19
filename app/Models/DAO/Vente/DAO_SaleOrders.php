<?php

namespace App\Models\DAO\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_saleOrders extends Model{

    private $order_id;
    private $customer_id;
    private $customer_lastName;
    private $customer_firstName;
    private $order_status;
    private $order_date;
    private $required_date;
    private $shipped_date;
    private $store_id;
    private $staff_id;

    function __construct($order_id,$customer_id,$customer_lastName,$customer_firstName,$order_status,$order_date,$required_date,$shipped_date,$store_id,$staff_id){

        $this->order_id=$order_id;
        $this->customer_id=$customer_id;
        $this->customer_lastName = $customer_lastName;
        $this->customer_firstname=$customer_firstName;
        $this->order_status=$order_status;
        $this->order_date=$order_date;
        $this->required_date=$required_date;
        $this->shipped_date=$shipped_date;
        $this->store_id=$store_id;
        $this->staff_id=$staff_id;
    }

    function toJSONPrivate(){
        return json_encode([
        'order_id'=>$this->order_id,
        'customer_id'=> $this->customer_id,
        'Name'=> $this->customer_lastName,
        'First_Name'=> $this->customer_firstname,
        'OrderStatus'=>$this->order_status,
        'DateOrder'=>$this->order_date,
        'requiredDate'=> $this->required_date,
        'shippedDate'=> $this->shipped_date,
        'store_id'=>$this->store_id,
        'staff_id'=>$this->staff_id
        ]);
    }

}