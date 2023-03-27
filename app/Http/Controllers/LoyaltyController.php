<?php

namespace App\Http\Controllers;

use App\Exports\LoyaltyExport;
use App\Models\Category;
use App\Models\Loyalty;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LoyaltyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض نقاط الولاء', ['only' => ['index']]);
        $this->middleware('permission:انشاء نقاط ولاء', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل نقاط الولاء', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف نقاط الولاء', ['only' => ['destroy']]);
    }

    public function export()
    {

//        dd('hh');
        return Excel::download(new LoyaltyExport, 'loyalty.xlsx');
    }

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
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:50|String',
            'phone' => 'required|max:50',

        ],
            [
                'required' => 'يجب ان تقوم بادخال كل الحقول',
                'unique'=>"يوجد حقل موجود مسبقا"
            ]
        )->validate();

        $c= Loyalty::find($request->id);


        $c->name=$request->name;
        $c->phone=$request->phone;
        $c->points=$request->points;
        $c->save();
//        dd($c);

        session()->flash("add","تم تعديل العميل بنجاح");
        return redirect("/loyalty");
    }

    public function destroy(Request $request)
    {
        Loyalty::find($request->id)->delete();
        session()->flash("del","تم حذف العميل بنجاح");
        return redirect("/loyalty");
    }
}
