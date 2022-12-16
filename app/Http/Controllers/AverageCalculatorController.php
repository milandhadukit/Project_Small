<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class AverageCalculatorController extends Controller
{
    //
    public function averageCalculator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'values' => 'required|regex:/^[\d\s,]*$/',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $values=$request->values;
        $a=(explode(',',$values));
        $maxValue=max($a);
        $minValue=min($a);
        $sum=array_sum($a);
        $count=count($a);
        $average=array_sum($a) / count(array_filter($a));
        $median=$count/2;
        $medianRound=round($median);
        $range=$maxValue-$minValue;

        return $this->sendResponse('success',['maxvalue'=>$maxValue,
                                                'minvalue'=>$minValue,
                                                'sum'=>$sum,
                                                'count'=>$count,
                                                'average'=>$average,
                                                'median'=>$medianRound,
                                                'range'=>$range,

                                            ]);

    }
}
