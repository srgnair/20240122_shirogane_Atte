<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class RestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = Carbon::now()->subWeeks(2);
        $endDate = Carbon::now()->addweeks(2);

        $randomDate = $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');
        
        $restStartTime = $this->faker->dateTimeBetween($randomDate . ' 00:00:00', $randomDate . ' 23:59:59');
        $restEndTime = $this->faker->dateTimeBetween($restStartTime, $randomDate . ' 23:59:59');

        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'attendance_id' => function () {
                return Attendance::factory()->create()->id;
            },
            'rest_start_time' => $restStartTime,
            'rest_end_time' => $restEndTime,
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
