<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PowerConveterController extends Controller
{
    //
    public function powerCalculator(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            // 'dob' => 'required|date',
            // 'date' => 'required|date|after:dob',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $milliwatts=$request->mw;

    }
}
