<?php

namespace Tests\DataProviders;

trait FriendsDataProvider
{
    public function twoFriendsDataProvider()
    {
        return [
            'Two friends' => [
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
                    ],
                    [
                        'name' => 'Danny2',
                        'email' => 'randomemail+1@randomemail.com',
                        'address' => [
                            'street_number' => 125,
                            'street_name' => '2nd Avenue',
                            'city' => 'Verdun',
                            'postal_code' => 'H4G 2V4'
                        ]
                    ]
                ],
            ]
        ];
    }
}
