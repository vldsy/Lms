<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => fake()->text(60),
            'description' => fake()->paragraph(),
            'available_from' => fake()->dateTimeBetween('-2 month', '+6 month'),
            'available_to' => fake()->dateTimeBetween('+4 month', '+10 month'),
        ];
    }

    /*
     $table->string('name', 60);
    $table->text('description')->nullable();
    $table->dateTime('available_from');
    $table->dateTime('available_to')->nullable();
    */
}
