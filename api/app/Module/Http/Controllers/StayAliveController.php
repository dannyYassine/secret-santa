<?php

namespace App\Module\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StayAliveController extends BaseController
{
    protected function index(Request $request): Response
    {
        return $this->buildResponse('Alive');
    }
}
