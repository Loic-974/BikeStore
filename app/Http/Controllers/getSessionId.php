<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class getSessionId extends Controller {

    function getId(Request $request){

        $result = $request->session()->get('roleManager');
        echo $result;
    }

}