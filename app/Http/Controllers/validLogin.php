<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff;

class validLogin extends Controller
{
   public function getLogin(){
     $toto = staff::all();
  
               
        // echo $_POST['emailLogin'];

        // foreach($toto as $test){

        //     if($test->{'email'}=== $_POST['emailLogin'])
        //     echo('yes');
        // }

    }
} 
