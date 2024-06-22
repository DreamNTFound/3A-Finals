<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => rand(1,2),
            'subject_code'  => $this->faker->randomKey(['1', '2', '3']),
            'name'          => $this->faker->name(),
            'description'   => $this->faker->paragraph(2),
            'instructor'    => $this->faker->name(),
            'schedule'      => array_rand([
                'MW 8AM-12PM' => 'MW 8AM-12PM',
                'MW 1PM-5PM' => 'MW 1PM-5PM',
                'TTH 8AM-12PM' => 'TTh 8AM-12PM',
                'TTH 1PM-5PM' => 'TTh 1PM-5PM',
            ]),
            'prelims'       => mt_rand(1.0 * 10, 5.0 * 10)/10, 
            'midterms'      => mt_rand(1.0 * 10, 5.0 * 10)/10,
            'prefinals'     => mt_rand(1.0 * 10, 5.0 * 10)/10,
            'finals'        => mt_rand(1.0 * 10, 5.0 * 10)/10,
            'date_taken' => $this->faker->date(),
        ];
    }
}
