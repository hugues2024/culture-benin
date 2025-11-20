<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function edit($id)
    {
        return view('langues.edit',compact('id'));
    }
}
