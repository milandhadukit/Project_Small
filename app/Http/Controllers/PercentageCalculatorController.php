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
            'amount' => 'regex:/^[0-9]+$/|max:3',
            'percentage' => 'regex:/^[0-9]+$/|max:3',
            'money' => 'regex:/^[0-9]+$/|max:3',
            'rate' => 'regex:/^[0-9]+$/|max:3',
            'value1' => 'regex:/^[0-9]+$/|max:3',
            'value2' => 'regex:/^[0-9]+$/|max:3',
            'from' => 'regex:/^[0-9]+$/|max:3',
            'to' => 'regex:/^[0-9]+$/|max:3',
            'percentGet' => 'regex:/^[0-9]+$/|max:3',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $req = $request->all();
        if (empty($req)) {
            return $this->sendResponse('success', 'Enter Any Value ');
        }

        $amount = $request->amount;
        $percentage = $request->percentage;
        $total = ($percentage / 100) * $amount;

        $money = $request->money;
        $rate = $request->rate;
        $calculate = ($money * $rate) / 100;

        $value = $request->value;
        $percent = $request->percent;
        $percentageResult = $value * $percent;

        $value1 = $request->value1;
        $value2 = $request->value2;
        // $cal4 = ($value1 / $value2) * 100;

        if ($value1 != 0) {
            $cal4 = ($value1 / $value2) * 100;
        } else {
            $cal4 = 0;
        }

        $from = $request->from;
        $to = $request->to;
        $sub = $to - $from;
        // $percentageChange = $sub / $from*100;

        if ($from != 0) {
            $percentageChange = ($sub / $from) * 100;
        } else {
            $percentageChange = 0;
        }

        $percentGet = $request->p;
        $enterPercent = $percentGet / 100;
        if ($percentGet != 0) {
            $enterPercent = $percentGet / 100;
        } else {
            $enterPercent = 0;
        }

        return $this->sendResponse('success', [
            '=' => $total,
            'calculate' => $calculate,
            '3No.%' => $percentageResult,
            '%of what?' => $cal4,
            'percentage change' => $percentageChange,
            'PercentDecimal' => $enterPercent,
        ]);
    }
}
