<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Rating::class;

    /**
     * @throws Exception
     */
    public function definition()
    {
        return [
            'numberRating'=> random_int(1,10),
            'user_id' => User::get()->random()->id,
            'product_id' => Product::get()->random()->id
        ];
    }
}
