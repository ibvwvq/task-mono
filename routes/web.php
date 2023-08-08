<?php

use Illuminate\Support\Facades\Route;


use App\Exports\FeedbackExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/first-command', function () {
    $data =  \App\Models\Feedback::FirstCommand();
    return Excel::download(new FeedbackExport(), 'feedback1.csv');
});

Route::get('/second-command', function () {
    $data =  \App\Models\Feedback::SecondCommand();
    return Excel::download((object)$data, 'feedback2.csv');
});
