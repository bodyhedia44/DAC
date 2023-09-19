<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
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
        $this->middleware('permission:دائن ومدين', ['only' => ['returns']]);
    }

    public function index(){
        $cats=Category::all();
        $prods=Product::all();
        $s=Setting::first();
        return view('pos.pos',compact('cats','prods','s'));
    }

public function perm(){
//    $permission = Spatie\Permission\Models\Permission::findByName('المرتجعات');
//    $permission->name = 'دائن ومدين';
//    $permission->save();
//    $permission->syncRoles($roles);
}

    public function invoice(Request $request){

        $invoice=Invoice::create([
            "money"=>$request->total,
            "payment_type"=>$request->i_option,
            "invoice_type"=>"عملية شراء",
            "user_id"=>Auth::user()->id,
            "tax"=>$request->tax,
            "invoice"=>$request->invoice
        ]);

        foreach ($request->items as $i){
            $item= Sale::findOrFail($i['id']);
            $item->sales=$item->sales+doubleval($i['quan']);
            $item->save();

            $item2= Inventory::findOrFail($i['id']);
            $item2->amount=$item2->amount-doubleval($i['quan']);
            $item2->save();
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
                'invoice'=>$request->invoice,
                "tax"=>$request->tax,
            ]);

            foreach ($request->items as $i){
               $item= Sale::findOrFail($i['id']);
               $item->sales=$item->sales+doubleval($i['quan']);
               $item->save();
               $item2= Inventory::findOrFail($i['id']);
               $item2->amount=$item2->amount-doubleval($i['quan']);
               $item2->save();
            }


            return redirect("/pos");
        }else{
            $s=Setting::first();

            $i=Invoice::create([
                "money"=> $request->type == "دائن"? $request->money*-1 : $request->money ,
                "payment_type"=>$request->number,
                "invoice_type"=>$request->type,
                "user_id"=>Auth::user()->id,
                'invoice'=>"
                        <tr class='tabletitle'>
                                            <td class='item'><h2>العنصر</h2></td>
                                            <td class='Hours'><h2>الكمية</h2></td>
                                            <td class='Rate'><h2>المجموع</h2></td>
                                        </tr>
                                         <tr>
                        <td><p class='itemtext'>$request->name</p></td>
                        <td class='tableitem'><p class='itemtext'>$request->quan</p></td>
                        <td class='tableitem'><p class='itemtext'>$request->money</p></td>
                    </tr>
                ",
                'tax'=>$s->tax*$request->money/100
            ]);

//            session()->flash("add","تم اضافة المرتجع بنجاح");
//            redirect('/returns');

            return Redirect::away("/showInvoice/".$i->uuid);

        }

    }
}
