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

    function getReportingData(){
        $date = date('Y-m-d H:i:s');
        // $week = $this->getWeeklyReporting();
        // $month = $this->getMonthlyReporting();
        // $panier = $this->getPanierMoyen();
        $test = $this->modelReporting->getReportingDataModel($date);
        // DD($week,$month,$panier);
        DD($test);
    
    }
}
