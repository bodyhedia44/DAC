<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index(){
        $cats=Category::all();
        $prods=Product::all();
        return view('pos.pos',compact('cats','prods'));
    }

    public function returns(){
        return view('pos.returns');
    }

    public function store(Request $request){
        if ($request->has("option")){
            Invoice::create([
                "money"=>$request->total,
                "payment_type"=>$request->option,
                "invoice_type"=>"عملية شراء",
                "user_id"=>Auth::user()->id,
            ]);

            foreach ($request->items as $i){
               $item= Sale::findOrFail($i['id']);
               $item->sales=$item->sales+doubleval($i['quan']);

               $item->save();
            }
        }else{
            Invoice::create([
                "money"=>$request->money*-1,
                "payment_type"=>"---",
                "invoice_type"=>"مرتجع",
                "user_id"=>Auth::user()->id,]);
            session()->flash("add","تم اضافة المرتجع بنجاح");
            return redirect('/returns');
        }


        return redirect('/pos');
    }
}
