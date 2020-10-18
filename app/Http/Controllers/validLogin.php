<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class validLogin extends Controller
{
   public function loginCheck(){

 
     $staffData = staff::all();
     $mail= $_POST['emailLogin'];
     
        if(isset($_POST)){
    
            if(!empty($mail) && (filter_var($mail,FILTER_VALIDATE_EMAIL))){    

                foreach($staffData as $staffUser){

                    if($staffUser ->{'email'}=== $mail){

                        if($staffUser->{'active'}== 1){

                            if($staffUser->{'password'} === $_POST['mdpLogin']){

                                $firstConnect=$staffUser->{'first_name'};

                                return Redirect::route('accueil',['firstConnect'=>$firstConnect]);

                            }else{

                                $error = 'Votre mot de passe est incorrect';
                                return view('login', ['error'=>$error]);
                            }

                        }else {

                            $error = ' Votre compte n\'existe pas ou n\'est pas activé';
                            return view('login', ['error'=>$error]);
                        }

                    }else{

                        $error = 'Adresse Mail incorrect';
                        return view('login', ['error'=>$error]);
                    }
                }
            }
        }
    }
} 