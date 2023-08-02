<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    public function test_a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Test Book Title',
            'author' => 'Victory',
        ]);

        $response->assertOk();
        $this->assertCount(1, Book::all());

    }

    public function test_a_title_is_required()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Victory',
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_a_book_can_updated()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'Test Book Title',
            'author' => 'Victory',
        ]);

        $book = Book::first()->id;

        // $this->withoutExceptionHandling();
        $response = $this->put('/books/'.$book, [
            'title' => 'Test Book Title update',
            'author' => 'Victory update',
        ]);

        $this->assertEquals('Test Book Title update', Book::first()->title);
        $this->assertEquals('Victory update', Book::first()->author);
    }
}
