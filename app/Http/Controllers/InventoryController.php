<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Exports\ProductExport;
use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:المخزون', ['only' => ['index']]);
        $this->middleware('permission:المخزون', ['only' => ['create','store']]);
        $this->middleware('permission:المخزون', ['only' => ['edit','update']]);
        $this->middleware('permission:المخزون', ['only' => ['destroy']]);
    }

    public function export()
    {
        return Excel::download(new InventoryExport, 'products.xlsx');
    }
    public function index()
    {
        $data=Inventory::all();
        return view("inventory.inventory",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $c= Inventory::find($request->id);
        $c->amount=$request->sales;
        $c->save();
//        dd($c);

        session()->flash("add","تم تعديل المخزون بنجاح");
        return redirect("/inventory");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
