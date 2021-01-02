<?php

namespace App\Models\DAO\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_ProductionCat extends Model
{
   private $category_id=0;
   private $category_name=null;

   function __construct($category_id,$category_name){
    $this->category_id=$category_id;
    $this->category_name=$category_name;
   }

   function getCategoryId(){
    $this->category_id;
   }

   function getCategoryName(){

    $this->category_name;
   }

   //permet d'acceder aux données dans le js et dans la view

   public function toJSONPrivate(){

    return json_encode([
        'category_id'=>$this->category_id,
        'categoryName'=>$this->category_name
    ]);
   }
}
