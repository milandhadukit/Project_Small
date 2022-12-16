<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Parking;

class ParkingLotManagementController extends Controller
{
    public function parkingRegister(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'owner_name' => 'required|regex:/^[a-zA-Z ]+$/',
                'car_name' => 'required',
                'car_number' => 'required|unique:parkings,car_number',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
            ],
            [
                
                'car_number.required' => 'Car already parking lot',

            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $parking = new Parking();
        $parking->owner_name = $request->owner_name;
        $parking->car_name = $request->car_name;
        $parking->car_number = $request->car_number;
        $parking->start_date = $request->start_date;
        $parking->end_date = $request->end_date;
        $parking->save();
        return $this->sendResponse('success', 'Successfully Add Car');
    }
    public function parkingList(Request $request)
    {
        $list = Parking::all();
        // return $this->sendResponse('success',$list);
        return $this->sendResponse('success', $list);
    }

    public function serchList(Request $request)
    {
        if (!empty($request->search)) {
            $users = Parking::where(
                'owner_name',
                'like',
                '%' . $request->search . '%'
            )->get();
        } else {
            $users = Parking::all();
        }
        return $this->sendResponse('success', $users);
    }

    public function countNumber(Request $request)
    {
        $a = view('count');
        return $a;
        //    return $this->sendResponse('success',$a);
    }
}
