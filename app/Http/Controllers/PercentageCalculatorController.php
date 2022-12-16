<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class PercentageCalculatorController extends Controller
{
    //
    public function percentageCalculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'dob' => 'required|date',
            // 'date' => 'required|date|after:dob',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $amount=$request->amount;
        $percentage=$request->percentage;
        $total=($percentage / 100) * $amount;

        $money=$request->money;
        $rate=$request->rate;
        $calculate=($money/$rate)*100;

        return $this->sendResponse('success',['%'=>$total,'calculate'=>$calculate]);



    }
}
