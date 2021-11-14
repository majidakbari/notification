<?php

namespace Database\Factories\Entities;

use App\Entities\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @method Notification make()
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'to' => $this->faker->randomElement([$this->faker->email, $this->faker->phoneNumber]),
            'name' => $this->faker->name,
            'message' => $this->faker->sentence,
            'type' => $this->faker->randomElement([Notification::TYPE_SMS, Notification::TYPE_EMAIL]),
            'sent' => $this->faker->boolean
        ];
    }
}
