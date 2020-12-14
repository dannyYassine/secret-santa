<?php

namespace App\Module\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Module\Services\DistributeFriendsDTO;
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

    protected function getIndex(Request $request): Response
    {
        $friends = [];
        if (!empty($request->query('friends'))) {
            $data = explode(',', $request->query('friends'));
            foreach ($data as $friend) {
                $friend_datum = explode('|', $friend);
                $friends[] = ['name' => $friend_datum[0], 'email' => $friend_datum[1]];
            }
        }

        return $this->buildResponse(
            $this->distributeFriendsService->execute(
                new DistributeFriendsDTO([
                    'friends' => $friends
                ])
            )
        );
    }

    protected function index(Request $request): Response
    {
        return $this->buildResponse(
            $this->distributeFriendsService->execute(
                new DistributeFriendsDTO($request)
            )
        );
    }
}
