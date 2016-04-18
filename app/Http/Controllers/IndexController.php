<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Item;
use Illuminate\Http\Request;
use Vinelab\Http\Facades\Client as HttpClient;

use App\Http\Requests;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function items(Request $request)
    {
        $response = null;

        if ($request->url) {

            if ($request->input('method') == 'GET') {

                $response = HttpClient::get($request->url);
            }
        }

        $items = Item::all();

        return view('index.items', compact('items', 'response'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function baskets(Request $request)
    {
        $response = null;

        if ($request->url) {

            $response = $this->sendRequest($request);
        }

        $baskets = Basket::all();

        return view('index.baskets', compact('baskets', 'response'));
    }


    /**
     * @param Request $request
     * @return array
     */
    private function getRequestData(Request $request)
    {
        $data = [];

        for ($i = 0; $i < count($request->key); $i++) {

            $data[$request->key[$i]] = $request->value[$i];
        }

        $data = array_merge(['_method' => $request->input('method')], $data);

        return [
            'url' => $request->url,
            'params' => $data
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    private function sendRequest(Request $request)
    {
        if ($request->input('method') == 'GET') {

            return HttpClient::get($request->url);

        } else {

            $params = $this->getRequestData($request);

            return HttpClient::post($params);
        }
    }
}
