<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;
class DateCalculatorController extends Controller
{
    //
    public function dateCalculator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'y' => 'regex:/^[0-9]+$/|max:4',
            'yplus' => 'regex:/^[0-9]+$/|max:3',
            'm' => 'regex:/^[0-9]+$/|max:2',
            'mplus' => 'regex:/^[0-9]+$/|max:2',
            'd' => 'regex:/^[0-9]+$/|max:2',
            'dplus' => 'regex:/^[0-9]+$/|max:2',
           
            
            

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $y = $request->y;
        $m = $request->m;
        $d = $request->d;
        $yplus = $request->yplus;
        $mplus = $request->mplus;
        $yersPlus = $y + $yplus;
        $monthPlus = $m + $mplus;
        $dplus = $request->dplus;
        $dayPlus = $d + $dplus;
        $week = $request->week;
        $weekPlus = $week * 7;
        $dayPlus = $dayPlus + $weekPlus;

        $divide = $monthPlus / 12;
        $aaa = floor($divide);
        $bbb = $aaa * 12;
        $ccc = $bbb - $monthPlus;
        $monthConvert = abs($ccc);

        return $dayPlus;

        if ($monthPlus > 12) {
            $yersCount = $yersPlus + floor($divide);
            $yersPlus = round($yersCount, 0);
            $monthPlus = $monthConvert;
            // $totalMonth=$monthPlus-12;
            //    $monthPlus=$totalMonth;
        }


        
        if ($dayPlus > 31) {
            $monthPlus = $monthPlus + 1;
            $toalDay = $dayPlus - 31;
            $dayPlus = $toalDay;
        }

        return $this->sendResponse('success', [
            'years' => $yersPlus,
            'month' => $monthPlus,
            'day' => $dayPlus,
        ]);
    }
}
