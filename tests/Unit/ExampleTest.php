<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\BuyItem;
use App\Models\User;
use Tests\TestCase;


class ExampleTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);

        $book = Book::factory()->create([
            'price' => 20
        ]);
        $book1 = Book::factory()->create([
            'price' => 13.30
        ]);

        $item = BuyItem::factory()->create([
            'user_id' =>   $user->id,
            'book_id' => $book->id,
        ]);
        $item1 = BuyItem::factory()->create([
            'user_id' =>   $user->id,
            'book_id' => $book1->id,
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function test_what_is_the_number_of_items_in_the_cart()
    {
        $totalItems = (new BuyItem)->numberOfCartItems();

        $this->assertEquals(2, $totalItems);
    }

    public function test_total_price_of_products_in_the_cart()
    {
        $totalPrice = (new BuyItem)->totalPrice();

        $this->assertEquals(33.30, $totalPrice);
    }
}
