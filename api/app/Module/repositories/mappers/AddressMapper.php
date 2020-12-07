<?php

namespace App\Module\Repositories\Mappers;

use App\Module\Models\Address;

class AddressMapper
{
    public static function toAddress(\stdClass $json): Address
    {
        $address = new Address();
        $address->street_number = $json->street_number;
        $address->street_name = $json->street_name;
        $address->city = $json->city;
        $address->postal_code = $json->postal_code;

        return $address;
    }
}
