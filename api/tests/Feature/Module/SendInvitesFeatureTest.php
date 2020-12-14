<?php

namespace Tests\Feature\Module;

use Tests\DataProviders\FriendsDataProvider;
use Tests\TestCase;

class SendInvitesFeatureTest extends TestCase
{
    use FriendsDataProvider;

    public function testSendInvitesToThreeFriendsViaGET()
    {
        $query = '?friends=Danny|dannyyassine@gmail.com,Danny2|dannyyassine@gmail.com';
        $response = $this->getJson('/api/distribute'.$query);

        $response->assertStatus(200);
    }

    /**
     * @dataProvider twoFriendsDataProvider
     */
    public function testSendInvitesToThreeFriendsViaPOST($friends)
    {
        $response = $this->post('/api/distribute', [
            'friends' => $friends
        ]);

        $response->assertStatus(200);
    }

    public function testFailureWhenEmptyFriends()
    {
        $response = $this->post('/api/distribute', [
            'friends' => []
        ]);

        $response->assertStatus(422);
    }
}
