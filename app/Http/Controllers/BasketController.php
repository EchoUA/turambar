<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class BasketController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baskets = Basket::all();

        if ( ! $baskets->count()) {

            return $this->responseNotFound();
        }

        return $this->outputCollection($baskets);
    }

    /**
     * Store a newly created resource in storage.*
     *
     * @param Request $request
     * @param Basket $basket
     * @return \Illuminate\Http\Response
     * @internal param $id
     */
    public function store(Request $request, Basket $basket)
    {
        if ($this->validation($request)->fails()) {

            return $this->setStatusCode(400)->respondWithError('Something is wrong with your params!');
        }

        return $this->createNew($basket, $request);
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basket = Basket::find($id);

        if ( ! $basket ) {

            return $this->responseNotFound();
        }

        return $this->basketOutput($basket);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->validationUpdate($request)->fails()) {

            return $this->setStatusCode(400)->respondWithError('Something is wrong with your params!');
        }

        $basket = Basket::find($id);

        return $this->updateBasket($basket, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $basket = Basket::find($id);

        if ( ! $basket ) {

            return $this->responseNotFound();
        }

        return $this->deleteBasket($basket);
    }


    /**
     * @param $baskets
     * @return array
     */
    private function outputCollection($baskets)
    {
        return array_map([$this, 'output'], $baskets->toArray());
    }


    /**
     * @param $basket
     * @return array
     */
    private function output($basket)
    {
        return [
            'name' => (string) $basket['name'],
            'contents' => (string) $basket['contents']
        ];
    }


    /**
     * @param $basket
     * @return mixed
     */
    private function basketOutput($basket)
    {
        return $this->respond([
            'data' => $this->output($basket)
        ]);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    private function validation(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'capacity' => 'required|integer'
        );

        return Validator::make($request->all(), $rules);
    }


    /**
     * @param Basket $basket
     * @param Request $request
     * @return mixed
     */
    private function createNew(Basket $basket, Request $request)
    {
        $basket->create($request->all());

        return $this->responseCreated();
    }


    /**
     * @param $basket
     * @param $request
     * @return mixed
     */
    private function updateBasket($basket, $request)
    {
        $basket->update($request->all());

        return $this->responseCreated('Successfully Updated!');
    }


    /**
     * @param $basket
     * @return mixed
     */
    private function deleteBasket($basket)
    {
        $basket->delete();

        return $this->responseCreated('Successfully Deleted!');
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function addItems(Request $request, $id)
    {
        if ( ! $request->items) {

            return $this->setStatusCode(400)->respondWithError('Something is wrong with your params!');
        }

        return $this->fillBasket($request, $id);
    }


    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    private function fillBasket($request, $id)
    {
        $basket = Basket::find($id);

        if ( ! $this->basketCapacity($request, $basket)) {

            return $this->setStatusCode(400)->respondWithError('Too heavy for this basket!');
        }

        return $this->saveToBasket($request, $basket);
    }


    /**
     * @param $request
     * @param $basket
     * @return bool
     */
    private function basketCapacity($request, $basket)
    {
        //$check_weight = Item::whereIn('id', $request->items)->lists('weight')->sum();
        $check_weight = '';

        foreach ($request->items as $id) {

            $check_weight += Item::where('id', $id)->lists('weight')->first();
        }

        return $check_weight <= $basket->capacity;
    }

    /**
     * @param $request
     * @param $basket
     * @return mixed
     */
    private function saveToBasket($request, $basket)
    {
        $basket->update([
            'contents' => implode(',', $request->items)
        ]);

        return $this->responseCreated('Successfully added to basket!');
    }


    /**
     * @param $request
     * @return mixed
     */
    private function validationUpdate($request)
    {
        $rules = array(
            '_method' => 'required',
            'name' => 'required',
            //'capacity' => 'required|integer'
        );

        return Validator::make($request->all(), $rules);
    }
}