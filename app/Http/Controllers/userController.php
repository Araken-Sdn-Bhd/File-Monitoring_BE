<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|string',
            'user_access' => 'required|string',
            'status' => 'required'
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

        $res = User::updateOrCreate(['email'=>$request->email],$dataUser);

        if ($res){return response()->json(["message" => "Record Successfully Saved", "code" => 200]);}
        
    }

    public function getUserList(Request $request)
    {
        $list = DB::table('users')
                ->join('settings', 'users.status', '=', 'settings.setting_id')
                ->select('users.*', 'settings.value as value')
                ->orderBy('users.user_id','asc')
                ->get();
        return response()->json(["message" => " List", 'list' => $list, "code" => 200]);
    }
}
