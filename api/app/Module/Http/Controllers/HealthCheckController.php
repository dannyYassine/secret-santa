<?php

namespace App\Module\Http\Controllers;

use App\Http\Controllers\BaseController;

class HealthCheckController extends BaseController
{
    public function index()
    {
        return $this->buildResponse(true);
    }
}
