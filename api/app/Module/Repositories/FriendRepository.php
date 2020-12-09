<?php

namespace App\Module\Repositories;

use App\Module\Repositories\Interfaces\IBaseRepository;
use App\Module\Repositories\Mappers\FriendMapper;

class FriendRepository implements IBaseRepository
{
    public function all(array $columns = ['*']): array
    {
        $friends_json = json_decode(file_get_contents(__DIR__ . '/friends.json'));
        return FriendMapper::toFriends($friends_json);
    }
}
