<?php

namespace Database\Factories;
// // // // cclient factory
// // // // cclient factory
// // // // cclient factory
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    protected $model = Client::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'age' => $this->faker->numberBetween(18, 60)
        ];
    }
}
