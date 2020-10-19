<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class validLogin extends Controller
{
   public function loginCheck(Request $request){

 
     $staffData = staff::all();
     $mail= $_POST['emailLogin'];
     
        if(isset($_POST)){
    
            if(!empty($mail) && (filter_var($mail,FILTER_VALIDATE_EMAIL))){    

                // foreach($staffData as $staffUser){
                for($i=0; $i<count($staffData);$i++){

                    if($staffData[$i]->{'email'}=== $mail){

                        if($staffData[$i]->{'active'}== 1){

                            if($staffData[$i]->{'password'} === $_POST['mdpLogin']){

                                $name=$staffData[$i]->{'first_name'};
                                session() -> regenerate();
                                $request->session()->put('name', $name);
                                $request->session()->put('roleManager', $staffData[$i]->{'role_user'});
                                return Redirect::route('accueil');

                            }else{
                                session() -> regenerate();
                                $error = 'Votre mot de passe est incorrect';
                                return view('login', ['error'=>$error],['mail'=>$mail]);
                            }

                        }else {
                            session() -> regenerate();
                            $error = ' Votre compte n\'existe pas ou n\'est pas activé';
                            return view('login', ['error'=>$error],['mail'=>$mail]);
                        }

                     
                    }else{
                         session() -> regenerate();
                         $error = 'Adresse Mail incorrect';
                         if($i >= (count($staffData)-1)){

                            return view('login', ['error'=>$error],['mail'=>$mail]);
                         }
                        
                    }
                }
            }
        }
    }
} 