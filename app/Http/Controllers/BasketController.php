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

        return $this->respond([
            'data' => $this->outputCollection($baskets)
        ]);
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
        if ($this->validation($request)->fails()) {

            return $this->setStatusCode(400)->respondWithError('Something is wrong with your params!');
        }

        $basket = Basket::find($id);

        if ( ! $basket ) {

            return $this->responseNotFound();
        }

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
}
