<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use App\Models\DAO\DAO_ProductionCat;
use App\Models\DAO\DAO_ProductionCat;

class Model_ProductionCat extends Model
{
 function getCategories(){

    $categories=DB::select('SELECT category_id, category_name from production.categories');
    $listCat = array();
    
    foreach($categories as $value){
        
        $cat = new DAO_ProductionCat($value->category_id,$value->category_name);

        array_push($listCat, $cat);

    }

    return $listCat;
}

}
