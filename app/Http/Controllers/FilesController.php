<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Files;
use Validator;
use Illuminate\Support\Facades\DB;


class FilesController extends Controller
{
    public function fileList(Request $request){
         $fileList = Files::select('*')
        ->where('user_id', $request->user_id)
        ->orderBy('file_name','asc')
        ->get();
        return response()->json(["message" => "File List", 'list' => $fileList, "code" => 200]);
    }
}