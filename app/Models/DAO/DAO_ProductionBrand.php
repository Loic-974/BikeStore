<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_ProductionBrand extends Model
{
    
private $brandId = 0;
private $brandName = null;


    function __construct($brandId,$brandName){

        $this->brandId = $brandId;
        $this->brandName = $brandName;
    }

    function getBrandId(){

        return $this->$brandId;
    }

    function getBrandName() {
        return $this->$brandName;
    }

    public function toJSONPrivate(){

        return json_encode(
           [
                'brandId'=>$this->brandId,
                'brandName' => $this->brandName
            ]
        );
    }

}
