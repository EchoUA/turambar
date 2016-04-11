<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

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
}
