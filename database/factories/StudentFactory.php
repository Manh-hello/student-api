<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => '09' . $this->faker->numerify('########'),
            'major' => $this->faker->randomElement([
                'Công nghệ thông tin',
                'Kinh tế',
                'Kế toán',
                'Marketing',
                'Quản trị kinh doanh'
            ]),
            'year' => $this->faker->numberBetween(2019, 2024)
        ];
    }
}

