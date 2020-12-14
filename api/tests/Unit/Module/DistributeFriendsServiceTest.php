<?php

namespace Tests\Unit\Module;

use App\Module\Exceptions\MinimumRequiredFriendsException;
use App\Module\Repositories\FriendRepository;
use App\Module\Repositories\Mappers\FriendMapper;
use App\Module\Services\DistributeFriendsDTO;
use App\Module\Services\DistributeFriendsService;
use App\Module\Utils\Mail\MailUtil;
use Illuminate\Validation\ValidationException;
use Tests\DataProviders\MissingFriendsDataProvider;
use Tests\TestCase;

class DistributeFriendsServiceTest extends TestCase
{
    use MissingFriendsDataProvider;

    public function testShouldResolveDependencies()
    {
        $this->assertNotNull(
            resolve(DistributeFriendsService::class)
        );
    }

    /**
     * @dataProvider notEnoughFriendsDataProvider
     */
    public function testThrowExceptionWhenMissingRequiredFriends(array $friends)
    {
        $this->expectException(MinimumRequiredFriendsException::class);

        $friendRepository = $this->createMock(FriendRepository::class);
        $mailUtil = $this->createMock(MailUtil::class);
        $mailUtil
            ->method('sendInvite');

        $service = new DistributeFriendsService($friendRepository, $mailUtil);
        $service->execute(new DistributeFriendsDTO(['friends' => $friends]));
    }

    public function testExecuteWhenEmptyFriends()
    {
        $this->expectException(ValidationException::class);

        $friendRepository = $this->createMock(FriendRepository::class);
        $mailUtil = $this->createMock(MailUtil::class);
        $mailUtil
            ->method('sendInvite');

        $service = new DistributeFriendsService($friendRepository, $mailUtil);
        $service->execute(new DistributeFriendsDTO(['friends' => []]));
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
}
