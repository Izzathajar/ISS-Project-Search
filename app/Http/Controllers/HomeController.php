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
        $time = $request->time; 
        $date = $request->date; 
        
        $timedate = Carbon::createFromFormat('Y-m-d H:i', $date.' '.$time)->timestamp;
        
        $hour_before = $timedate - 3600; 

        $time_nix = [];
        
        for ($x = 0; $x <= 12; $x++) {
            array_push($time_nix, $hour_before);
            $hour_before += 600;
        }
        
        $time_unix = implode(',', $time_nix);
        
        $data = Http::get('https://api.wheretheiss.at/v1/satellites/25544/positions?timestamps='.$time_unix.'&units=miles');
        $responses = $data->object();
        
        $combine = [];
        $coordinate = [];

        foreach($responses as $response){
            $longitude = $response->longitude;
            $latitude = $response->latitude;
            $data2 = Http::get('https://api.wheretheiss.at/v1/coordinates/'.$latitude.','.$longitude);
            array_push($coordinate, $data2->object());    
            //array_push($combine, $data->object(),$data2->object());
        }
        
        // $combine = array_merge($responses, $coordinate);
        log::info(gettype($latitude));
        //dd($combine);


        return view('result',compact('responses','time_nix','coordinate','latitude','longitude'));


        
    }
    
}
