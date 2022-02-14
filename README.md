## About ISS Project

This is a Laravel web application to get information about ISS (International Space Center). 

Example of information that we can get from this project are:
-Longitude
-Latitude
-Timstap
-Plotted map

## Extension Implemented
1.   Extension A
2.   Extension B
3.   Extension C

## How to Setup

Requirement
1.    PHP 7.4 ^

Setup
1.    git clone https://github.com/Izzathajar/ISS-Project-Search.git
2.    change to example-app  folder: cd example-app 
3.    run composer install 
4.    Duplicate .env.example file. Rename duplicated file to .env
5.    Copy OPENWEATHER_KEY=26d72f635d86cee96eeb834a36719411 then paste into the .env file (this key is exposed here for testing purpose)
6.    run php artisan serve
7.    open http://127.0.0.1:8000/ in the browser

Setup If Using Docker
1.    git clone https://github.com/Izzathajar/ISS-Project-Search.git
2.    change to example-app folder: cd example-app
3.    run docker-compose up -d 
4.    run docker exec -it example-app-php sh to enter into container
5.    run composer install 
6.    Duplicate .env.example file. Rename duplicated file to .env 
7.    open http://127.0.0.1:8000/ in the browser

## How to Use

This project is very and simple and easy to use. User just need to input date and time and click the search button. 



