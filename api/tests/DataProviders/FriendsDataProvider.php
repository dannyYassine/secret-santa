<?php

namespace Tests\DataProviders;

use Faker\Generator;
use Illuminate\Container\Container;

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
                        'name' => 'Danny3',
                        'email' => 'randomemail+22@randomemail.com',
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

    public function multipleFriendsIteration()
    {
        return [
            '2 friends' => [
                $this->generateFriends(2)
            ],
            '3 friends' => [
                $this->generateFriends(3)
            ],
            '4 friends' => [
                $this->generateFriends(4)
            ],
            '5 friends' => [
                $this->generateFriends(5)
            ],
            '6 friends' => [
                $this->generateFriends(6)
            ],
            '7 friends' => [
                $this->generateFriends(7)
            ],
            '8 friends' => [
                $this->generateFriends(8)
            ],
            '9 friends' => [
                $this->generateFriends(9)
            ],
            '10 friends' => [
                $this->generateFriends(10)
            ]
        ];
    }

    private function generateFriends($number_of_friends)
    {
        $friends = [];
        $i = 0;
        while ($i < $number_of_friends) {
            $friends[] = [
                'name' => 'Name'.$i,
                'email' => 'email+'.$i.'@email.com',
                'address' => [
                    'street_number' => 124 + $i,
                    'street_name' => 'Street Name ' . $i,
                    'city' => 'City ' . $i,
                    'postal_code' => 'Postal Code ' . $i
                ]
            ];
            $i += 1;
        }

        return $friends;
    }
}
