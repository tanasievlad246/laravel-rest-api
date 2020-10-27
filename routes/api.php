<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

//create a user route
Route::get('/user-create', function (Request $request) {
    //Create a user based on the request data that is sent to api
    App\Models\User::create([
        'name' => 'Vlad',
        'email' => 'vlad@email.com',
        'password' => Hash::make('zxcvbnm1')
    ]);
});

//login a user
Route::get('/login', function () {
    // $credentials = [
    //     'name' => 'Vlad',
    //     'password' => 'zxcvbnm1'
    // ];

    //request email and password that is sent to api route
    $credentials = request()->only(['email', 'password']);

    //generate authorization token
    $token = Auth::attempt($credentials);

    //return the authorization token
    return $token;
});

//get the authenticated user
//check for the token passed to the route with the middleware then send the data
Route::middleware('auth')->get('/me', function() {
    return \auth()->user();
});

//logout a user
