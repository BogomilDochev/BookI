<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug,
            'name' => $this->faker->name
//            'name' => $this->faker->randomElement([
//                'Adventure stories', 'Classics', 'Crime', 'Fairy tales, fables, and folk tales', 'Fantasy',
//                'Historical fiction', 'Horror', 'Humour and satire', 'Literary fiction', 'Mystery', 'Poetry', 'Plays',
//                'Romance', 'Science fiction', 'Short stories', 'Thrillers', 'War', 'Women’s fiction', 'Young adult',
//                'Autobiography and memoir', 'Biography', 'Essays', 'Non-fiction novel', 'Self-help'
//            ])
        ];
    }
}
