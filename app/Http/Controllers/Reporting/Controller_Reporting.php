<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporting\Model_Reporting;

class Controller_Reporting extends Controller
{
 
    private $modelReporting;

    function __construct(){

        $this->modelReporting = new Model_Reporting();
    }


    function getWeeklyReporting(){

        $week = $this->modelReporting->getWeeklyReport(date('Y-m-d H:i:s')); // replace date
        return $week;

    }

    function getMonthlyReporting(){

        $monthly = $this->modelReporting->getMonthlyReport(date('Y-m-d H:i:s')); // replace date
        return $monthly;
    }

    function getPanierMoyen(){
        $panier=$this->modelReporting->getMonthlyPanierMoyen();
        return $panier;
    }

    function getReportingData(Request $request){
       $date = $request->getContent()? date($request->getContent()): date('Y-m-d H:i:s');
        $test = $this->modelReporting->getReportingDataModel($date);
        return json_encode($test);
    }

    
}
