<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use App\Exports\FeedbackExport;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');


Artisan::command('first-command', function () {
   print_r(\App\Models\Feedback::FirstCommand());
})->purpose('Получить все отзывы, оставленные пользователями из Самары или Волгограда, отзывы которых были полезны для более чем 10 пользователей');;



Artisan::command('second-command', function () {
    print_r(\App\Models\Feedback::SecondCommand());
})->purpose('Получить все отзывы, оставленные пользователями которые оставили более 10 отзывов на товары стоимостью более 3 т.р., при среднем рейтинге всех отзывов пользователя на такие товары более 4.');


