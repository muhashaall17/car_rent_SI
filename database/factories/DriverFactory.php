<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition()
    {
        return [
            'cabang_id' => $this->faker->unique,
            'nama_driver' => $this->faker->name,
            'harga' => $this->faker->numberBetween(100000, 1000000),
        ];
    }
}
