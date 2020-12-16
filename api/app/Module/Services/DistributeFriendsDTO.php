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
    public array $friends;

    protected function extendRequestProps(Request $request): void
    {
        $this->friends = FriendMapper::toFriends(json_decode(json_encode($request['friends'])));
    }

    protected function extendArrayProps(array $array): void
    {
        $this->friends = FriendMapper::toFriends(json_decode(json_encode($array['friends'])));
    }


    protected function rules(): array
    {
        return [
            'friends' => ['required']
        ];
    }
}
