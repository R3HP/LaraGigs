<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ListingController::class,'index']);

Route::get('/listings/create', [ListingController::class,'create'])->middleware('auth');

Route::get('/listings/manage', [ListingController::class,'manage'])->middleware('auth');

Route::post('/listings', [ListingController::class,'store'])->middleware('auth');

Route::get('/listings/{listing}/edit', [ListingController::class,'edit'])->middleware('auth');

Route::put('/listings/{listing}', [ListingController::class,'update'])->middleware('auth');

Route::delete('/listings/{listing}',[ListingController::class,'destroy'])->middleware('auth');

Route::get('/listings/{listing}', [ListingController::class,'show']);


Route::get('/users/register',[UserController::class,'create'])->middleware('guest');

Route::post('/users',[UserController::class,'store']);

Route::post('/users/logout',[UserController::class,'logout'])->middleware('auth');

Route::get('/users/login',[UserController::class,'login'])->name('login')->middleware('guest');

Route::post('users/authenticate',[UserController::class,'authenticate']);

// Route::get('/hello',function () {
//     return response('<h1> Hello World </h1>');
// });

// Route::get('/posts/{id}', function ($id){
//     return response ('Post With Id :' . $id);
// }) -> where('id' , '[0-9]+');

// Route::get('/search',function(Request $request){
//     // dd($request->query());
//     return response('<h1>'. 'Name :' . $request->name.',City :' . $request->city . '</h1>');
// });
