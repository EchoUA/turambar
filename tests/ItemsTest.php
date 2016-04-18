<?php

use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ItemsTest
 */
class ItemsTest extends TestCase
{
    protected $url = 'api/v1/items/';

    /** @test */
    public function it_gets_all_items()
    {
        $this->seeInDatabase('items', ['type' => 'apple']);

        $this->get($this->url)
            ->seeJson()
            ->seeStatusCode(200)
        ;
    }


    /** @test */
    public function it_gets_specific_item()
    {
        $this->get($this->url)
            ->seeJson()
            ->seeStatusCode(200)
        ;
    }


    /** @test */
    public function it_returns_404_if_item_not_found()
    {
        $fake_id = Item::all()->max()->id + 1;

        $this->get($this->url . $fake_id)
            ->seeJsonContains(['status_code' => 404])
            ->seeStatusCode(404)
        ;
    }
}
