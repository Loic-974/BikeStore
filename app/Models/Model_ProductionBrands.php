<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\DAO_ProductionBrand;

class Model_ProductionBrands extends Model
{
    
    function selectBrandProduction() {

        $results = DB::select('SELECT brand_id, brand_name from production.brands');
        $listBrand= array();

        foreach ($results as $value){
            
            $brand=new DAO_ProductionBrand($value->brand_id,$value->brand_name);
            array_push($listBrand, $brand);
        }

        return $listBrand;
    }
}
