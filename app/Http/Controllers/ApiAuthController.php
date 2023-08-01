<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    function login(Request $request){
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|min:6',
//        ]);

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'خطأ في كلمة السر او الايميل',
                'code'=>401
            ], 401);
        }
        $user = User::where('email', $request->email)->first();



        return response()->json([
            'status' => true,
            'message' => 'تم تسجيل الدخول',
            'token' => $user->createToken("API TOKEN")->plainTextToken,
            'user'=>$user,
            'code'=>200
        ], 200);
    }


}
