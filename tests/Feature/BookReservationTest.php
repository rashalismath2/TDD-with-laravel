<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Book;

class BookReservationTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_book_can_be_added_to_the_library(){

        $this->withoutExceptionHandling();

        $response=$this->post('/book',[
            'title'=>'A Cool Books',
            'author'=>'Ismath'
        ]);

        $response->assertStatus(200);
        $this->assertCount(1,Book::all());
    }

    /** @test */
    public function a_title_is_required(){
         
        $response=$this->post('/book',[
            'title'=>'',
            'author'=>'Ismath'
        ]);

        $response->assertSessionHasErrors('title');

    }
    /** @test */
    public function a_author_is_required(){
         
        $response=$this->post('/book',[
            'title'=>'A cool book',
            'author'=>''
        ]);

        $response->assertSessionHasErrors('author');

    }
    /** @test */
    public function a_book_can_be_updated(){
         
        $this->post('/book',[
            'title'=>'A cool book',
            'author'=>'Ismath'
        ]);
        $book=Book::first();
        
        $response=$this->put('/book/'.$book->id,[
            'title'=>'A new book',
            'author'=>'New author'
        ]);

        $this->assertEquals('A new book',Book::first()->title);
        $this->assertEquals('New author',Book::first()->author);
    }
}