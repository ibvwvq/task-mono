<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Exports\FeedbackExport;
use Maatwebsite\Excel\Facades\Excel;
class Feedback extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function FirstCommand(): array
    {
        $users = DB::table('users')
        ->where('cityUser', 'Volgograd')
        ->orWhere('cityUser', 'Samara')
        ->get();

    $feedbacks = DB::table('feedback')->get();

    $array = [];
    foreach ($feedbacks as $feedback) {
        foreach ($users as $user) {
            if ($feedback->user_id == $user->id && $feedback->countMarkFeedback > 10) {
                $array[] =  $feedback->id;
            }
        }
    }
        Excel::download((object)$array, 'feedback1.csv');

        return $array;
    }

    public static function SecondCommand(){
         // получаем товары со стоимостью выше 3000 т.р.
    $products = DB::table('products')->where('priceProduct', '>', 3000)->get();
    // все пользователи
    $users = DB::table('users')->get();
    // перебираем каждого пользователя
    foreach ($users as $user) {
        // смотрим сколько отзывовов у каждого пользователя
        $feedbacks = DB::table('feedback')
            ->where('user_id', $user->id)
            ->get();
        // смотрим сколько всего пользователь ставил рейтингов
        $ratings = DB::table('ratings')
            ->where('user_id',$user->id)
            ->get();
        $countRating = 0;
        // просчитываем общий рейтинг отзывов которые проставил пользователь
        foreach ($ratings as $rating){
            $countRating += $rating->numberRating;
        }
        // проверяем если отзывов больше 10 и если общий рейтинг больше 4
        if($feedbacks->count()>10 && $countRating/$ratings->count()>4){
            // перебираем нужные товары которые мы нашли ранее и ищем на них отзывы
            foreach ($products as $product){
                foreach ($feedbacks as $feedback){
                    // проверяем
                    if($feedback->product_id == $product->id ){
                        // выводим отзыв
                        echo $countRating/$ratings->count() . PHP_EOL;
                        // полученный результат в файл csv

                        Excel::download((object)$feedback, 'feedback2.csv');
                        return $feedback->id . " - " . $feedback->textFeedback . PHP_EOL;
                    }
                }
            }
        }
    }
  }
}
