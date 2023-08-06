<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Sale;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function save_invoice(Request $request){

        $invoice=Invoice::create([
            "money"=>$request->total,
            "payment_type"=>$request->type,
            "invoice_type"=>"عملية شراء",
            "user_id"=>auth()->user()->id,
            "tax"=>$request->tax,
            "invoice"=>$request->invoice
        ]);

        $itemsArray = json_decode($request->items, true);

        foreach ($itemsArray as $i){
            $item= Sale::findOrFail($i['id']);
            $item->sales=$item->sales+doubleval($i['quan']);
            $item->save();

            $item2= Inventory::findOrFail($i['id']);
            $item2->amount=$item2->amount-doubleval($i['quan']);
            $item2->save();
        }

        return response()->json([
                'status' => true,
                'message' => 'تم حغظ الفاتورة',
                'data'=>$invoice->uuid,
                'code'=>200
            ]
        );
    }

    public function test_func(){
        return auth()->user();
    }
}
