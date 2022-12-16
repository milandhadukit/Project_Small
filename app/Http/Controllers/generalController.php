<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;

class generalController extends Controller
{
    //
    public function timeWatch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'dob' => 'required|date',
           
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $mytime = Carbon::now();
        // $time=$mytime->toDateTimeString();
        $format=$mytime->format('H:i:s');
        $hour=$mytime->format('H');
        $minute=$mytime->format('i');
        $second=$mytime->format('s');
          $a=$mytime->toArray();

        return $this->sendResponse('success',['FullDateTime'=>$a,'hour'=>$hour,'minute'=>$minute,'second'=>$second]);

    }

    public function pythagoreanTheorem (Request $request)
    {
        $a=$request->a;
        $b=$request->b;

        $sqrtA=sqrt($a);
        $sqrtB=sqrt($b);

        $c= $sqrtA+ $sqrtB;

        return $this->sendResponse('success',['Hypotenuse'=>$c]);



    }

}
