<?php

namespace App\Models\Vente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_Facture extends Model
{
   
    function getFactureFromOrderId($orderId){

        $result=DB::select('SELECT dbo.createFacture(?)',[$orderId]);
        return json_encode($result);
    }

}
