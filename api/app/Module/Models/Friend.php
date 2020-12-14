<?php

namespace App\Module\Models;

class Friend
{
    public string $name;
    public string $email;
    public ?Address $address;

    public function isEqual(Friend $friend): bool
    {
        return $this->name === $friend->name;
    }

    public function getPrettyAddress(): ?string
    {
        return !is_null($this->address) ? $this->address->getPrettyAddress() : null;
    }
}
