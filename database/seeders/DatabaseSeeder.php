<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            'Adventure stories', 'Classics', 'Crime', 'Fairy tales, fables, and folk tales', 'Fantasy',
            'Historical fiction', 'Horror', 'Humour and satire', 'Literary fiction', 'Mystery', 'Poetry', 'Plays',
            'Romance', 'Science fiction', 'Short stories', 'Thrillers', 'War', 'Women’s fiction', 'Young adult',
            'Autobiography and memoir', 'Biography', 'Essays', 'Non-fiction novel', 'Self-help'
        ];



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $bookCategories = [];

        foreach ($categories as $category) {
           Category::factory()->create([
                'name'=>$category
            ]);
        }


        for ($i = 0; $i < 5 ;$i++){
            Book::factory()->create([
                'category_id' => 1
            ]);
        }

        for ($i = 0; $i < 5 ;$i++){
            Book::factory()->create([
                'category_id' => 2
            ]);
        }

        Comment::factory()->create([

        ]);

    }
}
