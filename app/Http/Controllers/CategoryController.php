<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض التصنيفات', ['only' => ['index']]);
        $this->middleware('permission:انشاء تصنيفات', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل تصنيفات', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف تصنيف', ['only' => ['destroy']]);
    }
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
           "name"=>$request->name,

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

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:50|String',
        ],
            [
                'required' => 'يجب ان تقوم بادخال الاسم',
                'unique'=>"هذا الاسم موجود مسبقا"
            ]
        )->validate();
       $c= Category::find($request->id);
       $c->name=$request->name;
       $c->save();
        session()->flash("add","تم تعديل القسم بنجاح");
        return redirect("/category");
    }


    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        session()->flash("del","تم حذف القسم بنجاح");
        return redirect("/category");

    }
}
