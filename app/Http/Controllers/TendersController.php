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
        ->orderBy('submission_date','desc')
        ->orderBy('title','asc')
        ->get();
        return response()->json(["message" => "Tender List", 'list' => $tenderList, "code" => 200]);
    }
    public function tenderStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'client_id' => 'required',
            'submission_date' => 'required',
            'submission_price' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors(), "code" => 422]);
        }

        //tender requirement
        $tender_file = $request->file('tender');
        $file_name_tender = $tender_file->getClientOriginalName();
        $isUploaded_tender = upload_file($tender_file, 'tender/requirement'); //file, foldername
        $file_path_tender = $isUploaded_tender->getData()->path;
        //technical 
        $technical_file = $request->file('technical');
        $file_name_technical = $technical_file->getClientOriginalName();
        $isUploaded_technical = upload_file($technical_file, 'tender/technical'); //file, foldername
        $file_path_technical = $isUploaded_technical->getData()->path;
        //financial
        $financial_file = $request->file('financial');
        $file_name_financial = $financial_file->getClientOriginalName();
        $isUploaded_financial = upload_file($financial_file, 'tender/financial'); //file, foldername
        $file_path_financial = $isUploaded_financial->getData()->path;
        //others
        $others_file = $request->file('others');
        $file_name_others = $others_file->getClientOriginalName();
        $isUploaded_others = upload_file($others_file, 'tender/others'); //file, foldername
        $file_path_others = $isUploaded_others->getData()->path;

        $dataTender = [
            'title' => $request->title,
            'client_id' => $request->client_id,
            'reference_no' =>$request->reference_no,
            'submission_date'=>$request->submission_date,
            'submission_price'=> $request->submission_price,
            'tender_requirement'=>$file_name_tender,
            'tender_doc_path'=>$file_path_tender,
            'technical'=>$file_name_technical,
            'technical_doc_path'=>$file_path_technical,
            'financial'=>$file_name_financial,
            'financial_doc_path'=>$file_path_financial,
            'others'=>$file_name_others,
            'others_doc_path'=>$file_path_others,
        ];

        if($request->editId ==''){
          $res = Tenders::create($dataTender);
        }else{
            $res = Tenders::where('client_id',$request->editId)->update($dataTender);
        }

        if ($res) {
            return response()->json(["message" => "Record Successfully Saved", "code" => 200]);
        }
    }
}
