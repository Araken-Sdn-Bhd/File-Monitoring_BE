<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Validator;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function settingStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'parameter' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }
        $dataSetting = [
            'type' => $request->type,
            'parameter' => $request->parameter,
            'value' => $request->value,
            'code' => $request->code,
            'index' => $request->index,
            'description' => $request->description,
        ];

        if($request->editId ==''){
          $res = Settings::create($dataSetting);
        }else{
            $res = Settings::where('setting_id',$request->editId)->update($dataSetting);
        }

        if ($res) {
            return response()->json(["message" => "Record Successfully Saved", "code" => 200]);
        }
    }
    public function settingList()
    {
        $settingList = Settings::select('*')
        ->orderBy('type','asc')
        ->orderBy('index','asc')
        ->orderBy('parameter','asc')
        ->get();
        return response()->json(["message" => "Setting List", 'list' => $settingList, "code" => 200]);
    }
    public function typeList()
    {
        $typeList = Settings::select('type')
        ->groupBy('type')
        ->orderBy('index','asc')
        ->orderBy('parameter','asc')
        ->get();
        return response()->json(["message" => "Type List", 'list' => $typeList, "code" => 200]);
    }
    public function typeSearchList($type)
    {
        $settingList = Settings::select('*')
        ->where('type',$type)
        ->orderBy('index','asc')
        ->orderBy('parameter','asc')
        ->get();
        return response()->json(["message" => "Setting List", 'list' => $settingList, "code" => 200]);
    }
    public function deleteSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }
        $settingList = Settings::where(
            ['setting_id' => $request->id]
        );
        $settingList->delete();
        return response()->json(["message" => "Deleted Successfully.", "code" => 200]);
    }
}
