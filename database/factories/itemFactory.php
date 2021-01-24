<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\item;
use Illuminate\Database\Eloquent\Factories\Factory;

class itemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->numberBetween(10000, 999999),
            'description' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(1, 200),
            'category_id' => category::factory(),
            // 'image' => 'backend\dist\img\prod-' . rand(1, 4) . '.jpg'
        ];
    }
}
