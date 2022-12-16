<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Str;
class RandomGenratorController extends Controller
{
    //
    public function randomGenrate(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'random' => 'required|regex:/^[0-9]+$/|max:2',
            
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

         $firstName = ["Cathy Jones", "Jeremy Brown", "Tim Johnson" , "Alex Williams", "Skeletor Jackson", "Marcie Miller", "Theresa Taylor", "Blair Kennedy", "Megan Kennedy", "Andrew Richman", "Scott Richman", "Dominic Richman", "Daniel Richman", "Paul Richman"];
        

        $random = $request->random;
        for ($i = 0; $i < $random; $i++) {

            // $randomString[] = Str::random(10);
         
         
            $k= array_rand($firstName);
            $v[] = $firstName[$k];
        }
        return $this->sendResponse('success', ['random' => $v]);
    }
}
