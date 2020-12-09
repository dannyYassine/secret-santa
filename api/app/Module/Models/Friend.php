<?php

namespace App\Module\Models;

class Friend
{
    public string $name;
    public string $email;
    public Address $address;

    public function isEqual(Friend $friend): bool
    {
        return $this->name === $friend->name;
    }
}
