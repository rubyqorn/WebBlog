<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return home page 
    */
    public function showPage()
    {
       echo 'Hello World';
    }
}
