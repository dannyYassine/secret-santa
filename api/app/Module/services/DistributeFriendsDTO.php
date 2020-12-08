<?php

namespace App\Module\Services;

use App\Module\Models\Friend;
use App\Module\Repositories\Mappers\FriendMapper;
use App\Services\DTO\BaseDTO;
use Illuminate\Http\Request;

class DistributeFriendsDTO extends BaseDTO
{
    /**
     * @var Friend[]
     */
    private array $friends;

    protected function extendRequestProps(Request $request): void
    {
        $this->friends = FriendMapper::toFriends($request['friends']);
    }

}
