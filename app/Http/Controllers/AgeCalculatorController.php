<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
class AgeCalculatorController extends Controller
{
    //
    public function AgeCalculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dob' => 'required|date',
            'date' => 'required|date|after:dob',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $dateOfBirth = $request->dob;
        $endDate = $request->date;
        // $age = Carbon::parse($dateOfBirth)
        //     ->diff(Carbon::now())
        //     ->format('%y years, %m months and %d days');

        $toDate = Carbon::parse($dateOfBirth);
        $fromDate = Carbon::parse($endDate);
        $interval = date_diff($toDate, $fromDate);

        $results = $interval->format('%y years, %m months and %d days');

        return $this->sendResponse('success', $results);
    }
}
