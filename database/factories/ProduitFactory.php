<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categorie_id' => $this->faker->randomElement(Categorie::pluck('id')->toArray()),
            'prod_nom' => $this->faker->word,
            'prod_qte' => $this->faker->numberBetween(2, 100),
            'prod_pu' => $this->faker->numberBetween(100, 5000),
            'prod_image' => $this->faker->imageUrl('200', '200'),
        ];
    }
}
