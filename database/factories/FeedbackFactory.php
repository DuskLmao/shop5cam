<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order = \App\Models\Order::inRandomOrder()->first();
        return [
            'content' => $this->faker->sentence,
            'status' => $this->faker->numberBetween(0, 1),
            'order_id' => $order->id,
            'rate' => $this->faker->numberBetween(1, 5)
        ];
    }
}