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

        $time_nix = implode(',', $time_nix);
        
        $data = Http::get('https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps='.$time_nix.'&units=miles');
        $responses = $data->object();
        //dd($responses[0]['name']);
        // foreach($response as $iss) {
        //     Log::error($iss['latitude']);
        //     Log::error($iss['longitude']);

        // }
        
        return view('result',compact('responses'));
        //return redirect()->route('home', compact('response'));
    }   
}
