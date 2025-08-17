<?php

namespace Database\Factories;

use App\Models\MyClass;
use App\Models\ClassType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MyClassFactory extends Factory
{
    protected $model = MyClass::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Computer Science',
                'Information Technology', 
                'Software Engineering',
                'Business Administration',
                'Mathematics',
                'Physics',
                'Chemistry',
                'Biology'
            ]),
            'class_type_id' => 1, // Default class type
        ];
    }
}
