<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use Validator;

class LengthConveterController extends Controller
{
    //
    public function lengthCalculate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //  'inch' => 'required|date',
            

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $formulas = [
           

            'inch' => [
                'cm' => '*2.54',
                'feet' => '/12',
                'km' => '/39370.1',
                'm' => '*0.0254',
                'millimeter' => '* 25.4',
                'yards' => '/36',
                'decimeters' => '*0.254',
                'miles' => '/63360',
                'nauticalMiles' => '/185200*2.54',
            ],

            'feet' => [
                'cm' => '*30.48',
                'inches' => '*12',
                'km' => '*3.048e-4',
                'm' => '*0.3048',
                'millimeter' => ' * 304.8',
                'yards' => '/3',
                'decimeters' => '*3.048',
                'miles' => '/63360',
                'nauticalMiles' => '/185200*2.54*12',
            ],
            'km' => [
                'cm' => '*1e5',
                'inches' => '/2.54e-5',
                'feet' => '/2.54e-5/12',
                'm' => '*1e3',
                'millimeter' => '*1000000',
                'yards' => '0.0009144',
                'decimeters' => '*1e4',
                'miles' => '1.609344',
                'nauticalMiles' => '/1.852',
            ],

            'm' => [
                'cm' => '*100',
                'inches' => '/0.0254',
                'feet' => '/0.0254/12',
                'km' => '*1e3',
                'millimeter' => '*1000',
                'yards' => '/0.0254/36',
                'decimeters' => '*10',
                'miles' => ' /1609.344',
                'nauticalMiles' => '/1852',
            ],
            'millimeter' => [
                'cm' => '/10',
                'inches' => '/25.4',
                'feet' => '/25.4/12',
                'km' => '/1e6',
                'm' => '/1000',
                'yards' => '/25.4/36',
                'decimeters' => '/100',
                'miles' => '/1609344',
                'nauticalMiles' => '/1852000',
            ],
            'yards' => [
                'cm' => '*2.54*36',
                'inches' => '*36',
                'feet' => '*3',
                'km' => '*2.54e-5*36',
                'millimeter' => '*25.4*36',
                'm' => '*0.0254*36',
                'decimeters' => '*0.254*36',
                'miles' => '/5280*3',
                'nauticalMiles' => '/185200*2.54*36',
            ],
            'decimeters' => [
                'cm' => '*10',
                'inches' => '/0.254',
                'feet' => '/0.254/12',
                'km' => '/1e4',
                'millimeter' => '*100',
                'm' => '/10',
                'yards' => '/0.254/36',
                'miles' => '/16093.44',
                'nauticalMiles' => '/18520',
            ],
            "miles"=>
            [
                'cm' => '*160934.4',
                'inches' => '*63360',
                'feet' => '*5280',
                'km' => '*1.609344',
                'millimeter' => '*1609344',
                'm' => '*1609.344',
                'decimeters' => '*16093.44',
                'yards' => '*1760',
                'nauticalMiles' => '*1609.344/1852',
            ],
            "nauticalMiles"=>
            [
                'cm' => '*185200',
                'inches' => '* 1852 / 0.0254',
                'feet' => '* 1852 / 0.0254 / 12',
                'km' => '* 1.852',
                'millimeter' => '*1609344',
                'm' => ' * 1852',
                'decimeters' => '* 18520',
                'yards' => '* 1852 / 0.0254 / 36',
                'miles' => '* 1852 / 1609.344',
                
            ],
            'cm' => [
                'inches' => '/2.54',
                'feet' => '/12',
                'km' => '/100000',
                'm' => '/100',
                'millimeter' => '*12',
                'yards' => '/91.44',
                'decimeters' => '/10',
                'miles' => '/160934.4',
                'nauticalMiles' => '/185185.185',
            ],
            
        ];
  
      

  //CALULATION ON VALUE BASE ON FORMULA

        $removedNUllKeyAr = array_filter($request->all()); //remove null


        if(empty($removedNUllKeyAr))
        {
          
            return $this->sendResponse('success', 'Enter Any One Value'); 
        }

        $remainApplyFormulaAmount = array_values($removedNUllKeyAr)[0];  // array value je null nay hoy, [0]= je first hase te
        // dd($remainApplyFormulaAmount);

        $findKeyAr = array_keys($removedNUllKeyAr); //get key for array for not null
        // dd($findKeyAr);
        
        $output = [];
        //FIND FORMULAS
        $foundFormula =  isset($formulas[$findKeyAr[0]]) ? $formulas[$findKeyAr[0]] : null;
        // dd($foundFormula);
        if($foundFormula != null)
        {
            foreach($foundFormula as $formulaName => $formulaValue)
            {
                
                //$output[$formulaName] = ($remainApplyFormulaAmount.$formulaValue);//input ni value =remainApplyFormulaAmount

                $output[$formulaName] = eval('return '.$remainApplyFormulaAmount.$formulaValue.';');
               
            }   
            return $this->sendResponse('success',$output); 
           
              
           

        }
        
       
      




        // $nauticalMiles = $request->nauticalMiles;
        // $miles=$request->miles;
        // $decimeters=$request->decimeters;
        // $yards=$request->yards;
        // $millimeter=$request->millimeter;
        // $m=$request->m;
        // $km=$request->km;
        // $cm=$request->cm;
        // $inches=$request->inch;
        // $feet=$request->feet;

     


        

        // $nauticalMiles = $request->nauticalMiles;
        // $cm = $nauticalMiles * 185200;
        // $decimeters = $nauticalMiles * 18520;
        // $feet = ($nauticalMiles * 1852) / 0.0254 / 12;
        // $inches = ($nauticalMiles * 1852) / 0.0254;
        // $km = $nauticalMiles * 1.852;
        // $m = $nauticalMiles * 1852;
        // $miles = ($nauticalMiles * 1852) / 1609.344;
        // $millimeter = $nauticalMiles * 1852000;
        // $yards = ($nauticalMiles * 1852) / 0.0254 / 36;

        // $miles=$request->miles;
        // $cm=$miles*160934.4;
        // $decimeters=$miles*16093.44;
        // $feet =$miles*5280;
        // $inches = $miles*63360;
        // $km  = $miles*1.609344;
        // $m  = $miles*1609.344;
        // $millimeter = $miles*1609344;
        // $yards=$miles*1760;
        // $nauticalMiles=$miles*1609.344/1852;
        

        // $decimeters=$request->decimeters;
        // $cm=$decimeters*10;
        // $feet =$decimeters/0.254/12;
        // $inches = $decimeters/0.254;
        // $km  = $decimeters/1e4;
        // $m  = $decimeters/10;
        // $millimeter = $m*100;
        // $yards=$decimeters/0.254/36;
        // $miles=$decimeters/16093.44;
        // $nauticalMiles=$decimeters/18520;

        // $yards=$request->yards;
        // $cm=$yards*2.54*36;
        // $feet =$yards*3;
        // $inches = $yards*36;
        // $km  = $yards*2.54e-5*36;
        // $m  = $yards*0.0254*36;
        // $millimeter = $m*25.4*36;
        // $decimeters=$yards*0.254*36;
        // $miles=$yards/5280*3;
        // $nauticalMiles=$yards/185200*2.54*36;

        // $millimeter=$request->millimeter;
        // $cm=$millimeter/10;
        // $feet =$millimeter/25.4/12;
        // $inches = $millimeter/25.4;
        // $km  = $millimeter/1e6;
        // $m  = $millimeter/1000;
        // $yards=$millimeter/25.4/36;
        // $decimeters=$millimeter/100;
        // $miles=$millimeter/1609344;
        // $nauticalMiles=$millimeter/1852000;

        // $m=$request->m;
        // $cm=$m*100;
        // $feet =$m/0.0254/12;
        // $inches = $m/0.0254;
        // $km  = $m/1e3;
        // $millimeter = $m*1000;
        // $yards=$m/0.0254/36;
        // $decimeters=$m*10;
        // $miles=$m /1609.344;
        // $nauticalMiles=$m/1852;

        // $km=$request->km;
        // $cm=$km*1e5;
        // $feet =$km/2.54e-5/12;
        // $inches = $km/2.54e-5;
        // $m  = $km*1e3;
        // $millimeter = $km*1000000;
        // $yards=$km/ 0.0009144;
        // $decimeters=$km*1e4;
        // $miles=$km / 1.609344;
        // $nauticalMiles=$km/1.852;

        // $cm=$request->cm;
        // $inches = ceil($cm/2.54);
        // $feet =($inches/12);
        // $km  = $cm /100000;
        // $rkm = $cm % 100000;
        // $m  = $rkm / 100;
        // $millimeter = $cm * 10;
        // $yards=$cm/91.44;
        // $decimeters=$cm/10;
        // $miles=$cm/160934.4;
        // $nauticalMiles=$cm/185185.185;

        // $inches=$request->inch;
        // $cm=$inches*2.54;
        // $feet =($inches/12);
        // $km  = $inches /39370.1;
        // $m  = $inches*0.0254;
        // $millimeter = $inches * 25.4;
        // $yards=$inches/36;
        // $decimeters=$inches*0.254;
        // $miles=$inches/63360;
        // $nauticalMiles=$inches/185200*2.54;

        // $feet=$request->feet;
        // $cm=$feet*30.48;
        // $inches = $feet*12;
        // $km  = $feet*3.048e-4;
        // $m  = $feet*0.3048;
        // $millimeter = $feet * 304.8;
        // $yards=$feet/3;
        // $decimeters=$feet*3.048;
        // $miles=$feet/63360;
        // $nauticalMiles=$feet/185200*2.54*12;


     

        // return $this->sendResponse('success', [
        //     'inches' => $inches,
        //     'feet' => $feet,
        //     'km' => $km,
        //     'meter' => $m,
        //     'millimeter' => $millimeter,
        //     'yards' => $yards,
        //     'Decimeters' => $decimeters,
        //     'miles' => $miles,
        //     'nauticalMiles' => $nauticalMiles,
        //     'cm' => $cm,
        // ]);
    }
}
