<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_ProductionBrand extends Model
{
    
private $brand_id = 0;
private $brandName = null;


    function __construct($brand_id,$brandName){

        $this->brand_id = $brand_id;
        $this->brandName = $brandName;
    }

    function getBrandId(){

        return $this->$brand_id;
    }

    function getBrandName() {
        return $this->$brandName;
    }

    public function toJSONPrivate(){

        return json_encode(
           [
                'brand_id'=>$this->brand_id,
                'brandName' => $this->brandName
            ]
        );
    }

}
