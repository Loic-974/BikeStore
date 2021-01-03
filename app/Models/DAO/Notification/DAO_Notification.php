<?php

namespace App\Models\DAO\Notification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_Notification extends Model
{

    private $notification_id = 0;
    private $type = '';
    private $date = null;
    private $legende ='';
    private $order_id=null;
    private $store_id=0;
    private $status = 0;

    function __construct ($notification_id,$type,$date,$legende,$order_id,$store_id,$status){

        $this->notification_id=$notification_id;
        $this->type=$type;
        $this->date=$date;
        $this->legende=$legende;
        $this->order_id=$order_id;
        $this->store_id=$store_id;
        $this->status=$status;
    
    }

    function JSONToPrivate(){

        return json_encode([
            'notification_id'=>$this->notification_id,
            'type'=>$this->type,
            'date'=> $this->date,
            'legende'=>$this->legende,
            'order_id'=>$this->order_id,
            'store_id'=>$this->store_id,
            'status'=>$this->status
        ]);
    }
}
