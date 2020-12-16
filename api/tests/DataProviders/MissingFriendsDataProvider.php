<?php

namespace Tests\DataProviders;

trait MissingFriendsDataProvider
{
    public function notEnoughFriendsDataProvider()
    {
        return [
            'One friend' => [
                [
                    [
                        'name' => 'Danny1',
                        'email' => 'randomemail@randomemail.com',
                        'address' => [
                            'street_number' => 125,
                            'street_name' => '2nd Avenue',
                            'city' => 'Verdun',
                            'postal_code' => 'H4G 2V4'
                        ]
                    ]
                ]
            ]
        ];
    }
}
