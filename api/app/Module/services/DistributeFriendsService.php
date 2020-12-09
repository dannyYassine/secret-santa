<?php

namespace App\Module\Services;

use App\Module\Models\Friend;
use App\Module\Repositories\FriendRepository;
use App\Module\Utils\Mail\MailUtil;
use App\Module\Utils\Nexmo\NexmoUtil;

class DistributeFriendsService
{
    private array $numbers_to_exclude = [];
    private int $friends_count = 0;
    private array $friends = [];

    public MailUtil $mailUtil;
    public NexmoUtil $nexmoUtil;
    public FriendRepository $friendRepository;

    public function __construct(FriendRepository $friendRepository, MailUtil $mailUtil, NexmoUtil $nexmoUtil)
    {
        $this->friendRepository = $friendRepository;
        $this->mailUtil = $mailUtil;
        $this->nexmoUtil = $nexmoUtil;
    }

    public function execute(DistributeFriendsDTO $dto): bool
    {
        try {
            /* @var Friend[] $friends */
            $friends = $this->friendRepository->all();
            $this->friends_count = count($friends);

            $friends_recipients = $this->createRecipients($friends);

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

    private function send(array $friends_recipients): void
    {
        foreach ($friends_recipients as $friends_recipient) {
            $friend = $friends_recipient[0];
            $recipient = $friends_recipient[1];

            if ($friend->email) {
                $this->mailUtil->sendInvite($friend->email, $recipient);
            } else if ($friend->phone) {
                $this->nexmoUtil->sendInvite($friend->phone, $recipient);
            }
        }
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
