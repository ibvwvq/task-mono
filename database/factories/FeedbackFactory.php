<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'textFeedback' => $this->faker->text(),
            'countMarkFeedback' => random_int(0, DB::table('users')->count()),
            'rating_id'=>Rating::get()->random()->id,
            'user_id' => User::get()->random()->id,
            'product_id'=>Product::get()->random()->id
        ];
    }
}
