<?php

namespace App\Module\Repositories\Mappers;

use App\Module\Models\Friend;

class FriendMapper
{
    public static function toFriends(array $json_array): array
    {
        $friends = [];
        foreach ($json_array as $array) {
            $friends[] = self::toFriend($array);
        }

        return $friends;
    }

    public static function toFriend(\stdClass $json): Friend
    {
        $friend = new Friend();
        $friend->name = $json->name;
        $friend->email = $json->email;

        if (isset($json->address)) {
            $friend->address = AddressMapper::toAddress($json->address);
        }

        return $friend;
    }
}
