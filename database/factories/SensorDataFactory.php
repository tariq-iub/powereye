<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SensorData>
 */
class SensorDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $v1 = $this->faker->randomFloat(2, 0, 100);
        $i1 = $this->faker->randomFloat(2, 0, 10);

        $p1 = $v1 * $i1;
        $q1 = $p1 * 0.1;
        $e1 = $p1 / 1000 * 0.00277778;

        $v2 = $this->faker->randomFloat(2, 0, 100);
        $i2 = $this->faker->randomFloat(2, 0, 10);

        $p2 = $v2 * $i2;
        $q2 = $p2 * 0.1;
        $e2 = ($p2 / 1000) * 0.00277778;

        $v3 = $this->faker->randomFloat(2, 0, 100);
        $i3 = $this->faker->randomFloat(2, 0, 10);

        $p3 = $v3 * $i3;
        $q3 = $p3 * 0.1;
        $e3 = $p3 / 1000 * 0.00277778;

        return [
            'data_file_id' => 6,
            'timestamp'=> now(),
            'V1' => $v1,
            'I1' => $i1,
            'P1' => $p1,
            'Q1' => $q1,
            'E1' => $e1,
            'V2' => $v2,
            'I2' => $i2,
            'P2' => $p2,
            'Q2' => $q2,
            'E2' => $e2,
            'V3' => $v3,
            'I3' => $i3,
            'P3' => $p3,
            'Q3' => $q3,
            'E3' => $e3,
            'temperature' => $this->faker->randomFloat(2, -20, 50),
        ];
    }
}
