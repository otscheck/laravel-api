<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $status = $this->faker->randomElement(['BIlled', 'Paid', 'Cancel']);

        return [
            'amount' => $this->faker->numberBetween(100, 1000),
            'customer_id' => Customer::factory(),
            'status' => $status,
            'billed_date' => $this->faker->dateTimeThisDecade(),
            'paid_date' => $status=='Paid'? $this->faker->dateTimeThisDecade() : NULL
        ];
    }
}
