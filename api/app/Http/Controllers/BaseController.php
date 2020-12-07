<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    protected function buildResponse($data, int $status = Response::HTTP_OK): Response
    {
        $payload = [];

        if (is_array($data)) {
            $payload = array_merge($payload, $data);
        } else {
            $payload['data'] = $data;
        }


        return response($payload, $status);
    }
}
