<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $cat=Category::all();
        return view("products.category",compact('cat'));

    }


    public function create()
    {
        return view("products.add_category");
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:50|String',
        ],
        [
            'required' => 'يجب ان تقوم بادخال الاسم',
            'unique'=>"هذا الاسم موجود مسبقا"
        ]
        )->validate();

        Category::create([
           "name"=>$request->name
        ]);

        session()->flash("add","تم اضافة القسم بنجاح");
        return redirect("/category/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
