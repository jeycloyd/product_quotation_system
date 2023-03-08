<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        return view('home');
    }
}
