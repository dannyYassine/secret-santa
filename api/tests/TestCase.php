<?php

namespace Tests;

use App\Module\Repositories\FriendRepository;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createApplication();
    }

    public function getJsonResponse($response): \stdClass
    {
        return json_decode($response->getContent());
    }

//    public function createMock($class)
//    {
//        return $this->getMockBuilder(get_class($class))
//            ->disableOriginalConstructor()
//            ->getMock();
//    }
}
