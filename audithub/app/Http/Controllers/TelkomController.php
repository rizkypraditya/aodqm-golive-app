<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelkomController extends Controller
{
    function telkom(){
        return view('Telkom.telkom');
    }
}
