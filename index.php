<?php

require_once 'vendor/autoload.php';

use App\Services\DistributeFriendsService;

(new DistributeFriendsService())->execute();