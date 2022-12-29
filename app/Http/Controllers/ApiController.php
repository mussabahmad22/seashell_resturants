<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\Hash;
use App\Models\Seashell;

class ApiController extends Controller
{
    public function data(Request $request){

        $set = date_default_timezone_set("Asia/Karachi");
        $time = date("h:i:sa");
        

        $date =  date('d-m-Y');
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'ip' => 'required',
        ];
        $validator = FacadesValidator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $seashell = new Seashell();
        $seashell->name = $request->name;
        $seashell->phone = $request->phone;
        $seashell->ip = $request->ip;
        $seashell->date = $date;
        $seashell->time = $time; 
        $seashell->save();

        $res['status'] = true;
        $res['message'] = "Data Uploaded Sucessfully!!";
        $res['data'] = $seashell;
        return response()->json($res);

    }
}
