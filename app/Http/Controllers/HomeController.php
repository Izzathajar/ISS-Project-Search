<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; 

class HomeController extends Controller
{
    public function index ()
    {
        return view('welcome');
    }

    public function search(Request $request)
    {
        $time = $request->time; // '00:00'
        $date = $request->date; // '2022-01-22'
        
        // add date and time
        $timedate = Carbon::createFromFormat('Y-m-d H:i', $date.' '.$time)->timestamp;
        
        // $hour_before = $timedate->subHour();
        $hour_before = $timedate - 3600;

        Log::info($hour_before);

        $time_nix = [];
        
        for ($x = 0; $x <= 11; $x++) {
            $hour_before += 600;
            array_push($time_nix, $hour_before);
        }
        
        $time_unix = implode(',', $time_nix);
        
        $data = Http::get('https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps='.$time_unix.'&units=miles');
        $responses = $data->object();
        //dd($responses);
        $all_location = [];

        $coordinate = [];

        foreach($responses as $response){
            $longitude = $response->longitude;
            $latitude = $response->latitude;
            $data2 = Http::get('https://api.wheretheiss.at/v1/coordinates/'.$latitude.','.$longitude);
            array_push($coordinate, $data2->object());    
        }
         
        return view('result',compact('responses','time_nix'));
        

    }   
}
