<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class WorkTimeCalculatorController extends Controller
{
    //
    public function timeCalculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required|min:1|max:2|numeric',
            'month' => 'required|min:1|max:2|numeric',
            'day'=> 'required|min:1|max:12|numeric',
            'hour'=> 'required|min:1|max:60|numeric',
            'minute'=> 'required|min:1|max:60|numeric',
            'second'=> 'required|min:1|max:60|numeric',
            'years'=>'required|min:1|max:2|numeric',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $year=$request->year;
        $month=$request->month;
        $day=$request->day;
        $hour=$request->hour;
        $minute=$request->minute;
        $second=$request->second;


        $years=$request->years;
        $months=$request->months;
        $days=$request->days;
        $hours=$request->hours;
        $minutes=$request->minutes;
        $seconds=$request->seconds;

        $yearTotal=$year+$years;
        $monthTotal=$month+$months;
        $dayTotal=$day+$days;
        $hourTotal=$hour+$hours;
        $minuteTotal=$minute+$minutes;
        $secondTotal=$second+$seconds;

        return $this->sendResponse('success', ['yearsTotal'=>$yearTotal,
        'yearsTotal'=>$yearTotal,
        'monthTotal'=>$monthTotal,
        'dayTotal'=>$dayTotal,
        'hourTotal'=>$yearTotal,
        'minuteTotal'=>$hourTotal,
        'secondTotal'=>$secondTotal]);


    }
}
