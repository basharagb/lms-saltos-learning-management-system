<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\MyClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'code' => strtoupper($this->faker->bothify('??###')),
            'description' => $this->faker->paragraph(),
            'credit_hours' => $this->faker->numberBetween(1, 6),
            'my_class_id' => MyClass::factory(),
            'teacher_id' => User::factory()->create(['user_type' => 'teacher'])->id,
            'semester' => $this->faker->randomElement(['first', 'second', 'summer']),
            'academic_year' => '2023-2024',
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
