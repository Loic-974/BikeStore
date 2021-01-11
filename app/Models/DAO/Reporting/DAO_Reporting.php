<?php

namespace App\Models\DAO\Reporting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAO_Reporting extends Model
{
    
       private $nombreWeek=0;
       private $revenueWeek=0;
       private $unitSellWeek=0;
       private $nombreMonth=0;
       private $revenueMonth=0;
       private $unitSellMonth=0;
       private $panierMoyenMonth=0;
       private $poidsPromoMonth=0;

       function __construct($nombreWeek,$revenueWeek,$unitSellWeek,$nombreMonth,$revenueMonth,$unitSellMonth,$panierMoyenMonth,$poidsPromoMonth){

            $this->nombreWeek=$nombreWeek;
            $this->revenueWeek=$revenueWeek;
            $this->unitSellWeek=$unitSellWeek;
            $this->nombreMonth=$nombreMonth;
            $this->revenueMonth=$revenueMonth;
            $this->unitSellMonth=$unitSellMonth;
            $this->panierMoyenMonth=$panierMoyenMonth;
            $this->poidsPromoMonth=$poidsPromoMonth;
       }


      public function toJSONPrivate(){

        echo json_encode([
            'nombreWeek'=>$this->nombreWeek,
             'revenueWeek'=>$this->revenueWeek,
             'unitSellWeek'=>$this->unitSeelWeek,
             'nombreMonth'=>$this->nombreMonth,
             'revenueMonth'=>$this->revenueMonth,
             'unitSellMonth'=>$this->unitSellMonth,
             'panierMoyenMonth'=>$this->panierMoyenMonth,
             'poidsPromoMonth'=>$this->poidsPromoMonth
        ]);
      }

}
