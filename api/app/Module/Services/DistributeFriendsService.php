<?php

namespace App\Module\Services;

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
        if (!count($dto->friends)) {
            return false;
        }

        try {
            $this->friends_count = count($dto->friends);

            $friends_recipients = $this->createRecipients($dto->friends);

            $this->send($friends_recipients);
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }

    private function createRecipients(array $friends): array
    {
        $friends_recipients = [];

        foreach ($friends as $key => $friend) {
            $friend_index = $this->findNewFriend($friend, $friends);

            array_push($this->numbers_to_exclude, $friend_index);

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
        $friend_index = $this->getNewNumber(($this->friends_count - 1), $this->numbers_to_exclude);
        if ($friend->isEqual($friends[$friend_index])) {
            return $this->findNewFriend($friend, $friends);
        }

        return $friend_index;
    }

    private function getNewNumber(int $max, array $numbers_to_exclude): int
    {
        $new_number = mt_rand(0, $max);
        if (in_array($new_number, $numbers_to_exclude)) {
            return $this->getNewNumber($max, $numbers_to_exclude);
        }

        return $new_number;
    }
}
