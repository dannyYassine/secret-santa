<?php

namespace Bootstrap;

use Illuminate\Contracts\Console\Kernel;

class CreateApplication
{
    public static function create()
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
    }
}
