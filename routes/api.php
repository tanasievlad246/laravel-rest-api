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

//create a user
Route::post('/user-create', function () {
    //Create a user based on the request data that is sent to api
    $credentials = request()->only(['name', 'email', 'password']);

    App\Models\User::create([
        'name' => $credentials['name'],
        'email' => $credentials['email'],
        'password' => Hash::make($credentials['password'])
    ]);
});

//login a user
Route::post('/login', function () {
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
Route::middleware('auth')->post('/logout', function() {
    Auth::guard('api')->logout();
    return response()->json([
        'status' => 'success',
        'message' => 'logout'
    ], 200);
});


//request testing
//Route::get('/requestTest', function (Request $request) {
//    return response()->json($request->all());
//});

//route to post a to do, the controller checks for authorization token
Route::post('/todo/create', [\App\Http\Controllers\TodosController::class, 'store']);

//route to get all todos
Route::get('/todos', [\App\Http\Controllers\TodosController::class, 'index']);

//route to get one to do
Route::get('/todo/{id}', [\App\Http\Controllers\TodosController::class, 'show']);

//route to update a to do
Route::put('/todo/{id}/update', [\App\Http\Controllers\TodosController::class, 'update']);

//route to delete a to do
Route::delete('/todo/{id}/delete', [\App\Http\Controllers\TodosController::class, 'destroty']);
