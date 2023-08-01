<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Clients;
use Validator;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    public function clientStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string',
            'client_status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }
        $dataClient = [
            'client_name' => $request->client_name,
            'client_status' => $request->client_status,
        ];

        if($request->editId ==''){
          $res = Clients::create($dataClient);
        }else{
            $res = Clients::where('client_id',$request->editId)->update($dataClient);
        }

        if ($res) {
            return response()->json(["message" => "Record Successfully Saved", "code" => 200]);
        }
    }
    public function clientList()
    {
        $clientList = Clients::select('*')
        ->orderBy('client_name','asc')
        ->get();
        return response()->json(["message" => "Client List", 'list' => $clientList, "code" => 200]);
    }
   
    public function statusSearchList($status)
    {
        $clientList = Clients::select('*')
        ->where('client_status',$status)
        ->orderBy('client_name','asc')
        ->get();
        return response()->json(["message" => "Client List", 'list' => $clientList, "code" => 200]);
    }
    
}
