<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;
class BMICalculatorcontroller extends Controller
{
    //
    public function bmiCalculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'dob' => 'required|date',
            // 'date' => 'required|date|after:dob',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $ft=$request->ft;
        $in=$request->in;
     
        $weight=$request->weight;
        $height=$request->height;

        $bmi = $weight/($height*$height)*703;

        return $this->sendResponse('success',$bmi);









        // $bmi = $mass/($height*$height); 





    }
}
