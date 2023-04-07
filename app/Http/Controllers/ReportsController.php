<?php

namespace App\Http\Controllers;

use App\Exports\InvoiceExport;
use App\Exports\SaleExport;
use App\Models\Invoice;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:المبيعات', ['only' => ['productsReport','updateProducts']]);
        $this->middleware('permission:تقرير المنتجات', ['only' => ['salesReport']]);
    }

    public function exportInvoice()
    {
        return Excel::download(new InvoiceExport, 'invoices.xlsx');
    }

    public function exportSale()
    {
        return Excel::download(new SaleExport, 'sales.xlsx');
    }

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
        $data=Invoice::orderBy('created_at','desc')->get();
        return view("reports.sales_report",compact("data"));
    }
}
