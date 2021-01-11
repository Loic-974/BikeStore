<?php

namespace App\Models\Reporting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Reporting\DAO_Reporting;

class Model_Reporting extends Model
{
    
    function getWeeklyReport($date){
        $temp = DB::select('sales.weeklyReporting ?',array($date));
        return json_encode($temp);
    }

    function getMonthlyReport($date){
        $temp =  DB::select('sales.monthlyReporting ?',array($date));
        return json_encode($temp);
    }

    function getMonthlyPanierMoyen(){
        $temp = DB::select('sales.panierMoyen');
        return json_encode($temp);
    }

    function getReportingDataModel($date){
        $week = DB::select('sales.weeklyReporting ?',array($date));
        $month = DB::select('sales.monthlyReporting ?',array($date));
        $panier = DB::select('sales.panierMoyen');
        $finalArray=array($week,$month,$panier);
        $merged = array();
       
        foreach ($finalArray as $value=>$test) { 
                array_push($merged, $value=$test);
        }
        return $merged;
   

    }

    function _array_flatten($array) { 
        if (!is_array($array)) { 
          return false; 
        } 
        $result = array(); 
        foreach ($array as $key => $value) { 
          if (is_array($value)) { 
            $result = array_merge($result, array_flatten($value)); 
          } else { 
            $result = array_merge($result, array($key => $value));
          } 
        } 
        return $result; 
      }

}
