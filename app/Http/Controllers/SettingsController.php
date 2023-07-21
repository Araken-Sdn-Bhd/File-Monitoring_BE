<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Validator;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'=> 'required|string',
            'parameter' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }
        $dataSetting = [
            'type'=>$request->type,
            'parameter'=>$request->parameter,
            'value'=>$request->value,
            'code'=>$request->code,
            'index'=>$request->index,
            'description'=>$request->description,
        ];

        $res = Settings::create($dataSetting);

        if ($res){return response()->json(["message" => "Record Successfully Saved", "code" => 200]);}
        
    }
}