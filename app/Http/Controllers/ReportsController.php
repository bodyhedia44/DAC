<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    function productsReport(){
        $data=Sale::all();
        return view("reports.products_report",compact('data'));
    }

    function updateProducts(Request $request){

    }


    function salesReport(){
        $data=Invoice::all();
        return view("reports.sales_report",compact("data"));
    }
}
