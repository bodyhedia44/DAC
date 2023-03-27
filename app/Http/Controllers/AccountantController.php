<?php

namespace App\Http\Controllers;

use App\Exports\AccountantExport;
use App\Exports\ProductExport;
use App\Models\Accountant;
use Illuminate\Http\Request;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function show(Accountant $accountant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function edit(Accountant $accountant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accountant $accountant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accountant $accountant)
    {
        //
    }
}
