<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;


class BookTest extends TestCase
{
    /** @test */
    public function it_can_create_a_book(): void
    {
        Book::factory(1)->create();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function it_can_update_a_book(): void
    {
        $book = Book::factory()->create(['title' => 'Hamid']);
        $book->update(['title' => 'Ahmad']);
        $this->assertTrue($book->title === 'Ahmad');
    }

}
