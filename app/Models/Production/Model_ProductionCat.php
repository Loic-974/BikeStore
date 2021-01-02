<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Production\DAO_ProductionCat;

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

    function addCategory($catName){

        DB::insert('INSERT INTO production.categories (category_name) values (?)',[$catName]);
        $listCat = DB::select ('SELECT * From production.categories');

        $pushArray = array();

        foreach($listCat as $value){

            $temp = new DAO_ProductionCat($value->category_id, $value->category_name);
            array_push($pushArray, $temp);
        }

        return $pushArray;
        
    }


    function updateCategory($newName, $sourceId){

        DB::update('UPDATE production.categories set category_name = ? where category_id =?',[$newName,$sourceId]);
        $listCat = DB::select('SELECT * FROM production.categories');
        
        $pushArray = array();

        foreach($listCat as  $value){

            $temp = new DAO_ProductionCat($value->category_id, $value->category_name);
            array_push($pushArray,$temp);
        }

        return $pushArray;
    }

    function deleteCategory($catId){
        
        DB::delete('DELETE FROM production.categories where category_id = ?',[$catId]);

        $listCat = DB::select('SELECT * FROM production.categories');
        
        $pushArray = array();

        foreach($listCat as  $value){

            $temp = new DAO_ProductionCat($value->category_id, $value->category_name);
            array_push($pushArray,$temp);
        }

        return $pushArray;
    }
}
