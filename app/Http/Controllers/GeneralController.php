<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //

public function initial(Request $request){
    return response()->json([
        "message" => "Initial Api Routes SM"
    ]);
}


public function fallbackRoute(Request $request) {
    return response()->json([
        "message" => "Not found this route endpoint"
    ]);
}

public function webWelcome(){
    return view('welcome');
}

}
