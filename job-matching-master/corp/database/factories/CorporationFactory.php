<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CorporationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(5).$this->faker->company,
            'email' => Str::random(3).$this->faker->safeEmail,
            'password' => $this->faker->password,
            'tel' => $this->faker->phoneNumber(),
            'mobile_tel' => $this->faker->phoneNumber(),
            'image_path' => $this->faker->imageUrl($width = 640, $height = 480, $category = 'cats', $randomize = true, $word = null),
            'hp_url' => $this->faker->url,
            'business_location' => Str::random(10),
            'representative' => $this->faker->name,
            'establishment_date' => $this->faker->date,
            'capital' => rand(10000000,1000000000),
            'amount_sales' => rand(10000000,1000000000),
            'employees_number' => rand(500,2500),
            'business_content' => Str::random(10),
            'main_customer' => Str::random(10),
            'department_name' => Str::random(10),
            'manager_name' => $this->faker->name,
            'industry_id' => rand(1,10),
            'status' => rand(0,1),
        ];
    }
}
