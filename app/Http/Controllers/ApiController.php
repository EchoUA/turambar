<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    /**
     * @var int
     */
    private $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function responseNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }


    /**
     * @param string $message
     * @return mixed
     */
    public function responseCreated($message = 'Successfully created!')
    {
        return $this->setStatusCode(201)->respondWithMessage($message);
    }


    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }


    /**
     * @param $data
     * @return mixed
     */
    public function respond($data)
    {
        return Response::json($data, $this->getStatusCode());
    }


    /**
     * @param $message
     * @return mixed
     */
    private function respondWithMessage($message)
    {
        return $this->respond([
            'success' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }
}
