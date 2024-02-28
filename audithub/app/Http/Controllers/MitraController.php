<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;


class MitraController extends Controller
{
    // function report(){
    //     return view('Telkom.report');
    // }

    function report(){ 
        $Telkom_report=Report::all(); 
        return view ('Telkom.report', compact('Telkom_report'));
    } 
}

