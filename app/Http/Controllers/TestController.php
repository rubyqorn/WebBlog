<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Discussion;
use App\News;
use App\Role;

class TestController extends Controller
{
    public function test()
    {
    	$t = Role::find(1);
    	dd($t->users);
    }
}
