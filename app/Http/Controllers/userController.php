<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|string',
            //'user_access' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }
        $dataUser = [
            'email'=>$request->email,
            'password'=>bcrypt('123456'), //default password
            'user_access'=>$request->user_access,
            'status'=>$request->status,
        ];

        $res = User::create($dataUser);

        if ($res){return response()->json(["message" => "Record Successfully Saved", "code" => 200]);}
        
    }

    public function getUserList(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|string'
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(["message" => $validator->errors(), "code" => 422]);
        // }
        $list = User::select('user_id', 'email', 'user_access', 'status')
        ->get();
        return response()->json(["message" => " List", 'list' => $list, "code" => 200]);
    }
}
