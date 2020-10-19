<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logout extends Controller
{
    public function logout(Request $request){

        $request->session()->flush();
        return Redirect::route('/');

    }
}
