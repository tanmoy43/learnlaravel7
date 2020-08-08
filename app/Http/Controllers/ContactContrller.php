<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactContrller extends Controller
{
    public function contact(){
       return view('contact');
    }
}
