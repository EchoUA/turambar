<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $baskets = Basket::all();

        return view('welcome', compact('items', 'baskets'));
    }
}
