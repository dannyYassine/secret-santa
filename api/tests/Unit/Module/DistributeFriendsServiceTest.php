<?php

namespace Tests\Unit\Module;

use App\Module\Repositories\FriendRepository;
use App\Module\Services\DistributeFriendsDTO;
use App\Module\Services\DistributeFriendsService;
use App\Module\Utils\Mail\MailUtil;
use App\Module\Utils\Nexmo\NexmoUtil;
use Tests\TestCase;

class DistributeFriendsServiceTest extends TestCase
{
    public function testShouldResolveDependencies()
    {
        $this->assertNotNull(
            resolve(DistributeFriendsService::class)
        );
    }

    public function testExecuteWhenEmptyFriends()
    {
        $friendRepository = $this->createMock(FriendRepository::class);
        $mailUtil = $this->createMock(MailUtil::class);
        $mailUtil
            ->method('sendInvite')
            ->with($this->returnCallback(
                function ($email, $recipient) {
                    echo $email, $recipient;
                    return true;
                }
            ));
        $nexmoUtil = $this->createMock(NexmoUtil::class);

        $service = new DistributeFriendsService($friendRepository, $mailUtil, $nexmoUtil);
        $result = $service->execute(new DistributeFriendsDTO(['friends' => []]));

        $this->assertTrue($result);
    }
}
