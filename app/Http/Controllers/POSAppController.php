<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class POSAppController extends Controller
{
    public function get_items(){
        $categoriesWithProducts = Category::with('products')->get();
        return response()->json([
            'status' => true,
            'message' => 'تم جلب البيانات',
            'data'=>$categoriesWithProducts,
        'code'=>200
        ]
        );
    }
}
