<?php

namespace App\Module\Services;

use App\Module\Exceptions\MinimumRequiredFriendsException;
use App\Module\Models\Friend;
use App\Module\Repositories\FriendRepository;
use App\Module\Utils\Mail\MailUtil;

class DistributeFriendsService
{
    private array $numbers_to_exclude = [];
    private int $friends_count = 0;
    private array $friends = [];

    public MailUtil $mailUtil;
    public FriendRepository $friendRepository;

    public function __construct(FriendRepository $friendRepository, MailUtil $mailUtil)
    {
        $this->friendRepository = $friendRepository;
        $this->mailUtil = $mailUtil;
    }

    public function execute(DistributeFriendsDTO $dto): bool
    {
        if (count($dto->friends) < 2) {
            throw new MinimumRequiredFriendsException();
        }

        try {
            $this->friends_count = count($dto->friends);

            $friends_recipients = $this->createRecipients($dto->friends);

            $this->send($friends_recipients);
        } catch (\Throwable $e) {
//            throw $e;
            echo "ERROR: ". $e->getMessage();
            return false;
        }

        return true;
    }

    private function createRecipients(array $friends): array
    {
        $friends_recipients = [];
        $recipients = $friends;

        foreach ($friends as $key => $friend) {
            $excluded_myself_friends = array_filter($recipients, function (Friend $a) use ($friend) {
                return !$friend->isEqual($a);
            });
            $friend_index = $this->findNewFriend($friend, $excluded_myself_friends);

            unset($recipients[$friend_index]);

            array_push($friends_recipients, [
                $friend,
                $friends[$friend_index]
            ]);
        }

        return $friends_recipients;
    }

    /**
     * @throws \Throwable
     */
    private function send(array $friends_recipients): void
    {
        $this->mailUtil->sendInvites($friends_recipients);
    }

    private function findNewFriend(Friend $friend, array $friends): int
    {
        return $this->getNewNumber(count($friends));
    }

    private function getNewNumber(int $max): int
    {
        return random_int(0, $max);
    }
}
