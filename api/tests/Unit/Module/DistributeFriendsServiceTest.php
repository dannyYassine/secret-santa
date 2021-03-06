<?php

namespace Tests\Unit\Module;

use App\Module\Repositories\FriendRepository;
use App\Module\Repositories\Mappers\FriendMapper;
use App\Module\Services\DistributeFriendsDTO;
use App\Module\Services\DistributeFriendsService;
use App\Module\Utils\Mail\MailUtil;
use Tests\TestCase;

class DistributeFriendsServiceTest extends TestCase
{
    public function testShouldResolveDependencies()
    {
        $this->assertNotNull(
            resolve(DistributeFriendsService::class)
        );
    }

    /**
     * @dataProvider notEnoughFriendDataProvider
     */
    public function testReturnFalseWhenMissingFriends(array $friends)
    {
        $friendRepository = $this->createMock(FriendRepository::class);
        $mailUtil = $this->createMock(MailUtil::class);
        $mailUtil
            ->method('sendInvite');

        $service = new DistributeFriendsService($friendRepository, $mailUtil);
        $result = $service->execute(new DistributeFriendsDTO(['friends' => $friends]));

        $this->assertFalse($result);
    }

    public function testExecuteWhenEmptyFriends()
    {
        $friendRepository = $this->createMock(FriendRepository::class);
        $mailUtil = $this->createMock(MailUtil::class);
        $mailUtil
            ->method('sendInvite');

        $service = new DistributeFriendsService($friendRepository, $mailUtil);
        $result = $service->execute(new DistributeFriendsDTO(['friends' => []]));

        $this->assertFalse($result);
    }

    public function testExecuteWhenFriends()
    {
        $friend_json_1 = [
            'name' => 'Danny',
            'email' => 'randomemail@randomemail.com',
            'address' => [
                'street_number' => 125,
                'street_name' => '2nd Avenue',
                'city' => 'Verdun',
                'postal_code' => 'A1A 1A1'
            ]
        ];
        $friend_json_2 = [
            'name' => 'Danny1',
            'email' => 'randomemail+1@randomemail.com',
            'address' => [
                'street_number' => 125,
                'street_name' => '2nd Avenue',
                'city' => 'Verdun',
                'postal_code' => 'A1A 1A1'
            ]
        ];
        $friend1 = FriendMapper::toFriend(json_decode(json_encode($friend_json_1)));
        $friend2 = FriendMapper::toFriend(json_decode(json_encode($friend_json_2)));

        $friendRepository = $this->createMock(FriendRepository::class);
        $mailUtil = $this->createMock(MailUtil::class);
        $mailUtil
            ->method('sendInvite')
            ->withConsecutive(
                [$this->equalTo($friend1), $this->callback(function ($recipient) use ($friend2) {
                    return $recipient->isEqual($friend2);
                })],
                [$this->equalTo($friend2), $this->equalTo($friend1)]
            );

        $service = new DistributeFriendsService($friendRepository, $mailUtil);
        $result = $service->execute(new DistributeFriendsDTO(['friends' => [$friend_json_1, $friend_json_2]]));

        $this->assertTrue($result);
    }

    public function notEnoughFriendDataProvider()
    {
        return [
            'No friends' => [[]],
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
