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
        $coordinates = [];

        foreach($responses as $response){
            $longitude = $response->longitude;
            $latitude = $response->latitude;
            $data2 = Http::get('https://api.wheretheiss.at/v1/coordinates/'.$latitude.','.$longitude);
            $data3 = $data2->object();
            $response->country_code = $data3->country_code;
            array_push($coordinates, $data3);
            $get_weather = Http::get('api.openweathermap.org/data/2.5/weather?lat='.$latitude.'&lon='.$longitude.'&appid=26d72f635d86cee96eeb834a36719411');
            //$response->weather=$get_weather->
            $weather_response = $get_weather->object();
            $response->weather= $weather_response->weather[0];
            $response->icon="http://openweathermap.org/img/w/".$response->weather->icon.".png";
            $response->map = $data3->map_url;
        }
        

        return view('result',compact('responses','time_nix','coordinates','latitude','longitude'));


        
    }
    
}
