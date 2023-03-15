<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PosController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:صفحة نقاط البيع', ['only' => ['index','invoice','store']]);
        $this->middleware('permission:المرتجعات', ['only' => ['returns']]);
    }

    public function index(){
        $cats=Category::all();
        $prods=Product::all();
        $s=Setting::first();
        return view('pos.pos',compact('cats','prods','s'));
    }



    public function invoice(Request $request){
        $invoice=Invoice::create([
            "money"=>$request->total,
            "payment_type"=>"cash",
            "invoice_type"=>"عملية شراء",
            "user_id"=>Auth::user()->id,
            "invoice"=>$request->invoice
        ]);

        foreach ($request->items as $i){
            $item= Sale::findOrFail($i['id']);
            $item->sales=$item->sales+doubleval($i['quan']);
            $item->save();
        }
      return Redirect::away("/showInvoice/".$invoice->uuid);
//       return redirect("/pos");
    }


    function showInvcoice($id){
        $s=Setting::first();
        $invoice=Invoice::find($id);
        return view("pos.invoice",compact('s','invoice'));
    }


    public function returns(){
        return view('pos.returns');
    }


    public function store(Request $request){
        if ($request->has("option")){
            Invoice::create([
                "money"=>$request->net,
                "payment_type"=>$request->option,
                "invoice_type"=>"عملية شراء",
                "user_id"=>Auth::user()->id,
                'invoice'=>$request->invoice
            ]);

            foreach ($request->items as $i){
               $item= Sale::findOrFail($i['id']);
               $item->sales=$item->sales+doubleval($i['quan']);

               $item->save();
            }
            return redirect("/pos");
        }else{
            Invoice::create([
                "money"=>$request->money*-1,
                "payment_type"=>"---",
                "invoice_type"=>"مرتجع",
                "user_id"=>Auth::user()->id,
                'invoice'=>"-------"
            ]);

            session()->flash("add","تم اضافة المرتجع بنجاح");
            return redirect('/returns');
        }
    }
}
