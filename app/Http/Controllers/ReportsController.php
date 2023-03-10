<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportsController extends Controller
{
    function productsReport(){
        $data=Sale::all();
        return view("reports.products_report",compact('data'));
    }

    function updateProducts(Request $request){
//        Validator::make($request->all(), [
//            'name' => 'required|max:255|String',
//            'sales' => 'required|Numeric',
//        ],
//            [
//                'required' => 'يجب ان تقوم بادخال القول المطلوبة',
//            ]
//        )->validate();

        $data=Sale::findOrFail($request->id);

        $data->sales=$request->sales;

        $data->save();

        session()->flash("add","تم تعديل المنتج بنجاح");
        return redirect("/productsReport");

    }


    function salesReport(){
        $data=Invoice::all();
        return view("reports.sales_report",compact("data"));
    }
}
