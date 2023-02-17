<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Loyalty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoyaltyController extends Controller
{

    public function index()
    {
        $cat=Loyalty::all();
        return view("loyal.points",compact('cat'));

    }

    public function create()
    {
       return view("loyal.add_points");
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:loyalties|max:50|String',
            'phone' => 'required|unique:loyalties|max:50',

        ],
            [
                'required' => 'يجب ان تقوم بادخال كل الحقول',
                'unique'=>"يوجد حقل موجود مسبقا"
            ]
        )->validate();


        Loyalty::create([
            "name"=>$request->name,
            "phone"=>$request->phone,
            "points"=>$request->points,

        ]);

        session()->flash("add","تم اضافة العميل بنجاح");
        return redirect("/loyalty/create");
    }


    public function show(Loyalty $loyalty)
    {
        //
    }


    public function edit(Loyalty $loyalty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loyalty  $loyalty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loyalty $loyalty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loyalty  $loyalty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loyalty $loyalty)
    {
        //
    }
}
