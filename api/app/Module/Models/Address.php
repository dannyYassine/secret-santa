<?php

namespace App\Module\Models;

class Address
{
    public int $street_number;
    public string $street_name;
    public string $city;
    public string $postal_code;

    public function getPrettyAddress() : string
    {
        return "$this->street_number $this->street_name, $this->city, $this->postal_code";
    }
}
