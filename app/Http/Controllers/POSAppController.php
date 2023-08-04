<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class POSAppController extends Controller
{
    public function get_items(){
        $s=Setting::first();

        $categoriesWithProducts = Category::with('products')->get();
        return response()->json([
            'status' => true,
            'tax' =>$s->tax,
            'message' => 'تم جلب البيانات',
            'data'=>$categoriesWithProducts,
        'code'=>200
        ]
        );
    }
}
