<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class WelcomeController extends Controller
{
    //
    public function welcome(){
        $items = Item::all();

        return view('welcome')->with('items', $items);
    }
}
