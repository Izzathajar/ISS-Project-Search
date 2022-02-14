<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: "Open Sans", sans-serif;
            color: #444444;
            
        }
        .table-sm{
            font-size: 10px;
        }
        .test{
            width: 50%;
            float: left;
            padding: 10px;
        }
        table{
            border-radius: 20px;
            border-collapse: collapse;
        }
        footer{
            position: relative;
            bottom: 0px;
            width: 100%;
            margin-top: -100px;
        }
        .test2{
            width: 50%;
            float: left;
            padding: 30px;
            border: 1px solid red;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
        </nav>

        <main class="py-4">
            <!-- @yield('content') -->
            <div class="container mb-2 mt-2" style="margin: 0 auto;">
            <form action="{{ route('search') }}" method="post">
                    @csrf
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-6">
                            <input class="form-control form-control-lg" name="date" type="date" placeholder=".form-control-lg">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                            <div class="col-md-10">
                                <input class="form-control form-control-lg" name="time" type="time" placeholder=".form-control-lg">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-dark mt-1 float-right">Search</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="container mt-2">
                <div class="test">
                <table class="table table-dark table-hover table-striped table-sm "> 
                        <tr>
                            <th class="text-center">Satellite</th>
                            <th class="text-center">Latitude</th>
                            <th class="text-center">Longitude</th>
                            <th class="text-center">Timestamp</th>
                            <th class="text-center">Country Code</th>
                            <th class="text-center">Weather</th>
                            <th class="text-center">Google Map</th>
                        </tr>
                    <tbody>
                    @forelse($responses as $response)
                        <tr>
                            <td class="text-center">{{$response->name ?? ''}}</td>
                            <td class="text-center">{{$response->latitude ?? ''}}</td>
                            <td class="text-center">{{$response->longitude != '' ? $response->longitude : 'No Data'}}</td>
                            <td class="text-center">{{gmdate("Y/m/d h:ia", $response->timestamp) ?? ''}}</td>
                            <td class="text-center">{{$response->country_code != '??' ? $response->country_code : 'No Data'}}</td>
                            <td class="text-center">{{$response->weather->main != '' ? $response->weather->main : 'No Data'}}
                            <img src="{{$response->icon}}"  alt="Italian Trulli">
                            </td>
                            <td><a target="__blank" type="button" class = "btn btn-primary btn-sm" href="{{$response->map}}">Map</a></td>
                            @empty
                            <p>no data</p>
                        @endforelse
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="test">
                @include('map')
                </div>
            </div>
            </div>
        </main>
    </div>
</body>
</html>