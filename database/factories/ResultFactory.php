<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Result;

class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Result::class;
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'quiz_id' => rand(1, 10),
            'score' => rand(0, 100),
            'correct' => rand(1, 20),
            'wrong' => rand(1, 20),
        ];
    }
}