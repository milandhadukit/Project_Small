<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class BarGraphController extends Controller
{
    //
    public function barGraph(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //  'random' => 'required|regex:/^[0-9]+$/|max:2',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $title=$request->title;
        $horinzontalAxis=$request->haxis;
        




    }

}
