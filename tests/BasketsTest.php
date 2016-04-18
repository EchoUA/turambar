<?php

use App\Basket;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasketsTest extends TestCase
{
    protected $url = 'api/v1/baskets/';

    /** @test */
    public function it_checks_if_baskets_dont_exist()
    {
        $this->get($this->url)
            ->seeJson()
//            ->seeStatusCode(404)
        ;
    }

    /** @test */
    public function it_creates_basket_with_bad_params()
    {
        $data = [
            'wrong_key' => 'wrong_value'
        ];

        $this->post($this->url, $data)
            ->seeJson()
            ->seeStatusCode(400)
        ;
    }


    /** @test */
    public function it_creates_basket()
    {
        $data = [
            'name' => 'Test name ' . rand(1, 100),
            'capacity' => 5
        ];

        $this->post($this->url, $data)
            ->seeJson()
            ->seeStatusCode(201)
        ;
    }
    
    
    /** @test */
    public function it_gets_specific_basket()
    {
        $this->get($this->url . $this->randomBasketId())
            ->seeJson()
            ->seeStatusCode(200)
        ;
    }
    
    
    /** @test */
    public function it_returns_fake_basket()
    {
        $this->get($this->url . $this->fakeBasketId())
            ->seeJson()
            ->seeStatusCode(404)
        ;
    }
    
    
    /** @test */
    public function it_updates_specific_basket()
    {
        $data = [
            'name' => 'Test name ' . rand(1, 5),
            'capacity' => rand(1, 5)
        ];

        $this->put($this->url . $this->randomBasketId(), $data)
            ->seeJson()
            ->seeStatusCode(201)
        ;
    }


    /** @test */
    public function it_updates_specific_basket_with_bad_params()
    {
        $data = [
            'name' => 'Test name ' . rand(1, 5),
            'capacity' => 'string'
        ];

        $this->put($this->url . $this->randomBasketId(), $data)
            ->seeJsonContains(['status_code' => 400])
            ->seeStatusCode(400)
        ;
    }


    /** @test */
    public function it_updates_fake_basket()
    {
        $data = [
            'name' => 'Test name ' . rand(1, 5),
            'capacity' => rand(1, 5)
        ];

        $this->put($this->url . $this->fakeBasketId(), $data)
            ->seeJson()
            ->seeStatusCode(404)
        ;
    }


    /** @test */
    public function it_updates_fake_basket_with_bad_params()
    {
        $data = [
            'name' => 'Test name ' . rand(1, 5),
            'capacity' => 'string'
        ];

        $this->put($this->url . $this->fakeBasketId(), $data)
            ->seeJson()
            ->seeStatusCode(400)
        ;
    }


    /** @test */
    public function it_deletes_specific_basket()
    {
        $this->delete($this->url . $this->randomBasketId())
            ->seeJson()
            ->seeStatusCode(201);
    }


    /** @test */
    public function it_deletes_fake_basket()
    {
        $this->delete($this->url . $this->fakeBasketId())
            ->seeJson()
            ->seeStatusCode(404);
    }


    /** @test */
    public function it_gets_specific_basket_items()
    {
        $this->get($this->url . $this->randomBasketId() . '/items')
            ->seeJson()
            ->seeStatusCode(200)
        ;
    }


    /** @test */
    public function it_gets_fake_basket_items()
    {
        $this->get($this->url . $this->fakeBasketId() . '/items')
            ->seeJson()
            ->seeStatusCode(404)
        ;
    }


    /** @test */
    public function it_adds_items_to_specific_basket()
    {
        $data = [
            'items' => [
                1 => 1,
            ]
        ];

        $this->post($this->url . $this->randomBasketId() . '/items', $data)
            ->seeJson()
            ->seeStatusCode(201)
        ;
    }


    /** @test */
    public function it_adds_bad_items_to_specific_basket()
    {
        $data = [
            'items' => [
                0 => 'string',
                1 => 2,
                2 => 3,
            ]
        ];

        $this->post($this->url . $this->randomBasketId() . '/items', $data)
            ->seeJson()
            ->seeStatusCode(400)
        ;
    }


    /** @test */
    public function it_adds_items_to_fake_basket()
    {
        $data = [
            'items' => [
                0 => 1,
            ]
        ];

        $this->post($this->url . $this->fakeBasketId() . '/items', $data)
            ->seeJson()
            ->seeStatusCode(404)
        ;
    }


    /** @test */
    public function it_adds_bad_items_to_fake_basket()
    {
        $data = [
            'items' => [
                0 => 1,
                1 => 2,
                2 => 3,
            ]
        ];

        $this->post($this->url . $this->fakeBasketId() . '/items', $data)
            ->seeJson()
            ->seeStatusCode(404)
        ;
    }



    /**
     * @return mixed
     */
    private function randomBasketId()
    {
        return Basket::orderByRaw("RAND()")->first()->id;
    }


    /**
     * @return mixed
     */
    private function fakeBasketId()
    {
        return Basket::all()->max()->id + 1;
    }
}