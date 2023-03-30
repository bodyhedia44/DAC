<?php

namespace App\Http\Controllers;

use App\Exports\AccountantExport;
use App\Exports\ProductExport;
use App\Models\Accountant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AccountantController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:المحاسبة', ['only' => ['index']]);
        $this->middleware('permission:المحاسبة', ['only' => ['create','store']]);
        $this->middleware('permission:المحاسبة', ['only' => ['edit','update']]);
        $this->middleware('permission:المحاسبة', ['only' => ['destroy']]);
    }

    public function export()
    {
        return Excel::download(new AccountantExport, 'products.xlsx');
    }

    public function index()
    {
        $data=Accountant::all();

        return view("accountant.notes",compact('data'));
    }


    public function create()
    {
        return view("accountant.add_notes");
    }


    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255|String',
            'price' => 'required|max:50',
        ],
            [
                'required' => 'يجب ان تقوم بادخال القول المطلوبة',
            ]
        )->validate();

        $p=Accountant::create([
            "type"=>$request->name,
            'amount'=>$request->price,
            'notes'=>$request->notes,
        ]);

        session()->flash("add","تم اضافة المنتج بنجاح");
        return redirect("/accountant/create");
    }

    public function show(Accountant $accountant)
    {
        //
    }

    public function edit(Accountant $accountant)
    {
        //
    }

    public function update(Request $request, Accountant $accountant)
    {
        //
    }

    public function destroy(Accountant $accountant)
    {
        //
    }
}
