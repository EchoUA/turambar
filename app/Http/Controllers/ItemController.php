<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class ItemController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        if ( ! $items->count()) {

            return $this->responseNotFound();
        }

        return $this->respond([
            'data' => $this->outputCollection($items->all())
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

        if ( ! $item) {

            return $this->responseNotFound();
        }

        return $this->itemOutput($item);
    }


    /**
     * @param $items
     * @return array
     */
    private function outputCollection($items)
    {
        return array_map([$this, 'output'], $items);
    }


    /**
     * @param $item
     * @return array
     */
    private function output($item)
    {
        return [
            'type' => (string) $item['type'],
            'weight' => (int) $item['weight']
        ];
    }


    /**
     * @param $item
     * @return mixed
     */
    private function itemOutput($item)
    {
        return $this->respond([
            'data' => $this->output($item->toArray())
        ]);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getBasteWithItems($id)
    {
        $basket = Basket::with('items')->find($id);

        if (is_null($basket)) {

            return $this->responseNotFound();
        }

        return $this->respond([
            'data' => $this->outputCollection($basket->items->all())
        ]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function addItemsToBasket(Request $request, $id)
    {
        if ($this->validation($request)) {

            return $this->setStatusCode(400)->respondWithError('Something is wrong with your params!');
        }

        return $this->fillBasket($request, $id);
    }


    /**
     * @param $request
     * @return mixed
     */
    private function validation($request)
    {
        $rules = array(
            'items.*' => 'required|integer',
        );

        if ( ! $request->all()) {

            return true;
        }

        return Validator::make($request->all(), $rules)->fails();
    }


    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    private function fillBasket($request, $id)
    {
        $basket = Basket::find($id);

        if ( ! $basket ) {

            return $this->setStatusCode(400)->responseNotFound();
        }

        if ( ! $this->basketCapacity($request, $basket)) {

            return $this->setStatusCode(400)->respondWithError('Bad params!');
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

        $check_weight = '';

        if (is_array($request->items)) {

            foreach ($request->items as $id) {

                $item = Item::where('id', $id)->lists('weight')->first();

                if (is_null($item)) {

                    return false;
                }

                $check_weight += $item;
            }

            return $check_weight <= $basket->capacity;
        }

        return false;
    }


    /**
     * @param $request
     * @param $basket
     * @return mixed
     */
    private function saveToBasket($request, $basket)
    {
        $basket->items()->sync($request->items);

        return $this->responseCreated('Successfully Updated!');
    }
}
