<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = Carbon::now()->subWeeks(2); 
        $endDate = Carbon::now()->addWeeks(2); 

        $randomDate = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');

        $clockInTime = $this->faker->dateTimeBetween($randomDate . ' 00:00:00', $randomDate . ' 23:59:59');
        $clockOutTime = $this->faker->dateTimeBetween($clockInTime, $randomDate . ' 23:59:59');

        return [
            'user_id' => User::factory()->create()->id,
            'clock_in_time' => $clockInTime,
            'clock_out_time' => $clockOutTime,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
