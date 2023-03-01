<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(){
        $cats=Category::all();
        $prods=Product::all();
        return view('pos.pos',compact('cats','prods'));
    }
}
