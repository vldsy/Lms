<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $courses = Course::pluck('id');

        return [
            'name'  => fake()->text(100),
            'description' => fake()->paragraph(),
            'available_from' => fake()->dateTimeBetween('-2 month', '+6 month'),
            'available_to' => fake()->dateTimeBetween('+4 month', '+10 month'),
            'max_points' => fake()->randomFloat(null, 1.0, 5.0),
            'course_id' => $courses->random(),
        ];
    }
    /*
    $table->string('name', 100);
    $table->text('description');
    $table->dateTime('available_from');
    $table->dateTime('available_to')->nullable();
    $table->float('max_points');
    $table->foreignId('course_id')->nullable();
    //$table->foreignId('course_category_id')->nullable();
    */
}
