<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;
use App\Models\Address;

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
        $format = $mytime->format('H:i:s');
        $hour = $mytime->format('H');
        $minute = $mytime->format('i');
        $second = $mytime->format('s');
        $a = $mytime->toArray();

        return $this->sendResponse('success', [
            'FullDateTime' => $a,
            'hour' => $hour,
            'minute' => $minute,
            'second' => $second,
        ]);
    }

    public function pythagoreanTheorem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'dob' => 'required|date',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        //Hypotenuse (c) calculation:
        $a = $request->a;
        $b = $request->b;
        $sqrtA = sqrt($a);
        $sqrtB = sqrt($b);
        $c = $sqrtA + $sqrtB;

        $legB = $request->legb;
        $hypotenuseC = $request->hc;
        $legA = sqrt($hypotenuseC * $hypotenuseC - $legB * $legB);

        $ainput = $request->ainput;
        $cinput = $request->cinput;
        $legB = sqrt($cinput * $cinput - $ainput * $ainput);

        return $this->sendResponse('success', [
            'Hypotenuse C' => $c,
            'leg A' => $legA,
            'leg B' => $legB,
        ]);
    }

    public function addressBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'mobile' =>
                'required|min:10|max:13|regex:/^([0-9\s\-\+\(\)]*)$/|unique:addresses,mobile',
            'address' => 'required',
            'email' => 'required|string|email|max:100|unique:addresses',
            'website' => 'required',
            //  'website'=> ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $addressData = new Address();
        $addressData->name = $request->name;
        $addressData->address = $request->address;
        $addressData->mobile = $request->mobile;
        $addressData->email = $request->email;
        $addressData->website = $request->website;
        $addressData->save();

        return $this->sendResponse('success', 'Successfully Add ');
    }

    public function contactList()
    {
        $list = Address::all();
        return $this->sendResponse('success', $list);
    }
    public function contactDelete($id)
    {
        $deleteContact = Address::find($id);

        if (empty($deleteContact)) {
            return $this->sendResponse('success', 'Not Available Data ');
        }
        $deleteContact = Address::find($id);
        $deleteContact->delete();
        return $this->sendResponse('success', 'Delete  Successfully ');
    }

    public function energyCalculator(Request $request)
    {
        $validator = Validator::make($request->all(), [
           
            'kwh'=>'nullable|regex:/^[0-9]+$/',
            'kw'=>'nullable|regex:/^[0-9]+$/',
            'gj'=>'nullable|regex:/^[0-9]+$/',
            'mj'=>'nullable|regex:/^[0-9]+$/',
            'kj'=>'nullable|regex:/^[0-9]+$/',
            'btu'=>'nullable|regex:/^[0-9]+$/',
            'kbtu'=>'nullable|regex:/^[0-9]+$/',
            'j'=>'nullable|regex:/^[0-9]+$/',
            'mwh'=>'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $energy = [
            'kwh' => [
                'wh' => '*1e3',
                'mwh' => '/1e3',
                'btu' => '*3412.14163312794',
                'kbtu' => '*3.41214163312794',
                'j' => '*3.6e6',
                'kj' => '*3.6e3',
                'mj' => '*3.6',
                'gj' => '*3.6e-3',
            ],

            'wh' => [
                'kwh' => '/1e3',
                'mwh' => '/1e6',
                'btu' => '*3.41214163312794',
                'kbtu' => '*3.41214163312794e-3',
                'j' => '*3.6e3',
                'kj' => '*3.6',
                'mj' => '*3.6e-3',
                'gj' => '*3.6e-6',
            ],

            'mwh' => [
                'kwh' => '*1e3',
                'wh' => '*1e6',
                'btu' => '*3.41214163312794e6',
                'kbtu' => '*3.41214163312794e3',
                'j' => '*3.6e9',
                'kj' => '*3.6e6',
                'mj' => '*3.6e3',
                'gj' => '*3.6',
            ],
            'btu' => [
                'kwh' => '/3.41214163312794e3',
                'wh' => '/3.41214163312794',
                'mwh' => '/3.41214163312794e6',
                'kbtu' => '/1e3',
                'j' => '*1055.05585262',
                'kj' => '*1055.05585262e-3',
                'mj' => '*1055.05585262e-6',
                'gj' => '*1055.05585262e-9',
            ],
            'kj' => [
                'kwh' => '/3.41214163312794e3',
                'wh' => '/3.6e3',
                'mwh' => '/3.6e6',
                'kbtu' => '/1055.05585262',
                'btu' => '/1055.05585262e-3',
                'mj' => '/1e3',
                'j' => '*1e3',
                'gj' => '/1e6',
            ],
            'mj' => [
                'kwh' => '/3.6',
                'wh' => '/3.6e-3',
                'mwh' => '/3.6e3',
                'kbtu' => '/1055.05585262e-3',
                'btu' => '/1055.05585262e-6',
                'kj' => '*1e6',
                'j' => '*1e3',
                'gj' => '/1e3',
            ],
            'gj' => [
                'kwh' => '/3.6e-3',
                'wh' => '/3.6e-6',
                'mwh' => '/3.6',
                'kbtu' => '/1055.05585262e-6',
                'btu' => '/1055.05585262e-9',
                'kj' => '*1e6',
                'j' => '*1e9',
                'mj' => '*1e3',
            ],
            'kbtu' => [
                'kwh' => '/3.41214163312794',
                'wh' => '/3.41214163312794e-3',
                'mwh' => '/3.41214163312794e3',
                'btu' => '*1e3',
                'j' => '*1055.05585262e3',
                'kj' => '*1055.05585262',
                'mj' => '*1055.05585262e-3',
                'gj' => '*1055.05585262e-6',
            ],
            'j' => [
                'kwh' => '/3.6e6',
                'wh' => '/3.6e3',
                'mwh' => '/3.6e9',
                'kbtu' => '/1055.05585262e3',
                'btu' => '/1055.05585262',
                'mj' => '/1e6',
                'kj' => '/1e3',
                'gj' => '/1e9',
            ],
        ];

        $reqNullRemove = array_filter($request->all());
        if (empty($reqNullRemove)) {
            return $this->sendResponse('success', 'Enter Any One Value');
        }

        $value = array_values($reqNullRemove)[0];

        $findArrayKey = array_keys($reqNullRemove);

        //FIND FORMULAS
        $findFormula = isset($energy[$findArrayKey[0]])
            ? $energy[$findArrayKey[0]]
            : null;

        $output = [];
        if ($findFormula != null) {
            foreach ($findFormula as $keyName => $formulaValues) {
                $output[$keyName] = eval(
                    'return ' . $value . $formulaValues . ';'
                ); 
            }

            return $this->sendResponse('success', $output);
           
        }
        
    }
}
