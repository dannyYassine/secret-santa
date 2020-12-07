<?php

namespace App\Module\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Module\Services\DistributeFriendsService;

class DistributeController extends BaseController
{
    private DistributeFriendsService $distributeFriendsService;

    public function __construct(DistributeFriendsService $distributeFriendsService)
    {
        $this->distributeFriendsService = $distributeFriendsService;
    }

    protected function index(Request $request): Response
    {
        return $this->buildResponse($this->distributeFriendsService->execute());
    }
}
