<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الاعدادات', ['only' => ['index','store']]);
    }
    public function index()
    {
        $data=Setting::first();
        return view("settings.settings",compact('data'));
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
        Validator::make($request->all(), [
            'name' => 'required|max:255|String',
            'location' => 'required|max:50',
        ],
            [
                'required' => 'يجب ان تقوم بادخال القول المطلوبة',
            ]
        )->validate();

        if ($request->hasFile('img')){
            $path = $request->file('img')->store('logo','public');
        }else{
            $path="logo/default.jpg";
        }
        $data=Setting::first();

           $data->name=$request->name;
           $data->location=  $request->location;
        $data->tax_number=  $request->tax_num;
        $data->tax=  $request->tax;
           $data->img= $path;

           $data->save();


        session()->flash("add","تم التعديل بنجاح");
        return redirect("/settings");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
