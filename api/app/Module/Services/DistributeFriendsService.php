<?php

namespace App\Module\Services;

use App\Module\Exceptions\MinimumRequiredFriendsException;
use App\Module\Models\Friend;
use App\Module\Repositories\FriendRepository;
use App\Module\Utils\Mail\MailUtil;

class DistributeFriendsService
{
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

        $friends_recipients = $this->createRecipients($dto->friends);
        $this->send($friends_recipients);

        return true;
    }

    private function createRecipients(array $friends): array
    {
        $friends_recipients = [];
        $bin_recipients = $friends;

        foreach ($friends as $key => $friend) {
            $excluded_myself_friends = array_filter($bin_recipients, function (Friend $a) use ($friend) {
                return !$friend->isEqual($a);
            });
            $excluded_myself_friends = array_values($excluded_myself_friends);

            if (empty($excluded_myself_friends)) {
                $this->swapLastPerson($friend, $friends_recipients);
                return $friends_recipients;
            }

            $friend_index = $this->findNewFriend($excluded_myself_friends);

            array_push($friends_recipients, [
                $friend,
                $excluded_myself_friends[$friend_index]
            ]);

            $bin_recipients = array_filter($bin_recipients, function (Friend $a) use ($excluded_myself_friends, $friend_index) {
                return !$a->isEqual($excluded_myself_friends[$friend_index]);
            });
        }

        return $friends_recipients;
    }

    private function swapLastPerson(&$friends_recipients, $friend, $index = 0): void
    {
        $friends_recipient = $friends_recipients[$index];
        $recipient = $friends_recipient[1];
        $friends_recipient[1] = $friend;
        array_push($friends_recipients, [
            $friend,
            $recipient
        ]);
    }

    /**
     * @throws \Throwable
     */
    private function send(array $friends_recipients): void
    {
        $this->mailUtil->sendInvites($friends_recipients);
    }

    private function findNewFriend(array $friends): int
    {
        return $this->getNewNumber(count($friends) - 1);
    }

    private function getNewNumber(int $max): int
    {
        return random_int(0, $max);
    }
}
