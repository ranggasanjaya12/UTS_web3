<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dummy;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DummyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Dummy::class;

    public function definition()
    {
        return [
            'nip' => $this->faker->numerify('##########'), // NIP dengan 10 digit angka acak
            'nama' => $this->faker->name(),
        ];
        
    }
}
