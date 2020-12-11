<?php

use App\Module\Services\DistributeFriendsDTO;
use App\Module\Services\DistributeFriendsService;
use Bootstrap\CreateApplication;
require __DIR__.'/vendor/autoload.php';
CreateApplication::create();

$service = resolve(DistributeFriendsService::class);
$friends = [
    [
        'name' => 'Danny',
        'email' => 'dannyyassine@gmail.com',
        'address' => [
            'street_number' => 125,
            'street_name' => '2nd Avenue',
            'city' => 'Verdun',
            'postal_code' => 'H4G 2V4'
        ]
    ],
    [
        'name' => 'Danny1',
        'email' => 'dannyyassine+1@gmail.com',
        'address' => [
            'street_number' => 125,
            'street_name' => '2nd Avenue',
            'city' => 'Verdun',
            'postal_code' => 'H4G 2V4'
        ]
    ]
];

$result = $service->execute(new DistributeFriendsDTO(['friends' => $friends]));
