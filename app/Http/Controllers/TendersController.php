<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenders;
use Validator;
use Illuminate\Support\Facades\DB;

class TendersController extends Controller
{  
    public function tenderList()
    {
        $tenderList = Tenders::select('*')
        ->orderBy('title','asc')
        ->get();
        return response()->json(["message" => "Tender List", 'list' => $tenderList, "code" => 200]);
    }
}
