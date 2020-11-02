<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class SignOut extends Controller
{
    public function SignOut(Request $request){

        $request->session()->flush();

        return Redirect::route('/');

    }
}
