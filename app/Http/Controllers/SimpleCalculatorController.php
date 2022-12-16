<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class SimpleCalculatorController extends Controller
{
    //
    public function simpleCalculator(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            // 'dob' => 'required|date',
            // 'date' => 'required|date|after:dob',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $value1=$request->value1;
        $value2=$request->value2;

        $mul=$value1+$value2;
        $sub=$value1-$value2;
        $multi=$value1*$value2;
        $division=$value1/$value2;

        return $this->sendResponse('success',['multiplaction'=>$mul,'sub'=>$sub,'mul'=>$multi,'division'=>$division]);





    }
}
