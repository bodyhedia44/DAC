<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:حذف منتج|تعديل منتجات|انشاء منتجات|عرض المنتجات', ['only' => ['index','store']]);
        $this->middleware('permission:انشاء منتجات', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل منتجات', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف منتج', ['only' => ['destroy']]);
    }

    public function index()
    {
        $cat=Product::all();
        $cats=Category::all();
        return view("products.products",compact('cat','cats'));
    }


    public function create()
    {
        $cats=Category::all();
        return view("products.add_product",compact("cats"));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255|String',
            'price' => 'required|max:50',
            'category' => 'required',
        ],
            [
                'required' => 'يجب ان تقوم بادخال القول المطلوبة',
            ]
        )->validate();

        if ($request->hasFile('img')){
            $path = $request->file('img')->store('products','public');
        }else{
            $path="";
        }

        $p=Product::create([
            "name"=>$request->name,
            'price'=>$request->price,
            'code'=>$request->code,
            'img'=>$path,
            'category_id'=>$request->category
        ]);

        Sale::create([
            "id"=>$p->id,
            "name"=>$request->name,
        ]);

        session()->flash("add","تم اضافة المنتج بنجاح");
        return redirect("/product/create");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255|String',
            'price' => 'required|max:50',
            'category' => 'required',
        ],
            [
                'required' => 'يجب ان تقوم بادخال القول المطلوبة',
            ]
        )->validate();

        if ($request->hasFile('img')){
            $path = $request->file('img')->store('products','public');
        }else{
            $path="";
        }

        $c= Product::find($request->id);
        $c->name=$request->name;
        $c->price=$request->price;
        $c->category_id=$request->category;
        $c->code=$request->code;
        $c->img=$path;
        $c->save();

        session()->flash("add","تم تعديل المنتج بنجاح");
        return redirect("/product");
    }


    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        session()->flash("del","تم حذف المنتج بنجاح");
        return redirect("/product");
    }
}
