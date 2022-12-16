<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Validator;

class CarInsuranceGeneratorController extends Controller
{
    //
    public function carGenerate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //  'random' => 'required|regex:/^[0-9]+$/|max:2',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

       
        $data=Car::select('car_name','price','level','year')->find($request->id);
        return $this->sendResponse('success', ['id' => $data]);
       

       

    }
}
