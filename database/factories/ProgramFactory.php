<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
			'program_title' =>  $faker->unique()->company,
			'program_age_rating' => 9,
			'program_description' => $faker->name,
			'program_type' => $faker->city
		];
    }
}
