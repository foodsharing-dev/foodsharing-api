<?php
namespace AppBundle;
use AppBundle\ApiTester;

class SessionCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    public function checkNonExistantLogin(ApiTester $I)
    {
        $I->wantTo('request my user information although I am not logged in');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept','application/json');
        $I->sendGET('/session');
        $I->seeResponseCodeIs(404);
    }

    public function loginWithWrongCredentials(ApiTester $I)
    {
        $I->wantTo('login with wrong credentials');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept','application/json');
        $I->sendPOST('/session', ['email' => 'user1@example.com', 'password' => 'wrong']);
        $I->seeResponseCodeIs(403);
    }

    public function login(ApiTester $I)
    {
        $I->wantTo('login with correct credentials');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept','application/json');
        $I->sendPOST('/session', ['email' => 'user1@example.com', 'password' => 'user1']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('user.id');
        $I->seeResponseJsonMatchesJsonPath('user.firstName');
        $I->seeResponseJsonMatchesJsonPath('user.lastName');
    }

    public function loginWithEmptyCredentials(ApiTester $I)
    {
        $I->wantTo('login with empty credentials');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept','application/json');
        $I->sendPOST('/session', ['email' => '', 'password' => '']);
        $I->seeResponseCodeIs(403);
    }

    public function loginWithoutCredentials(ApiTester $I)
    {
        $I->wantTo('login without credentials');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept','application/json');
        $I->sendPOST('/session');
        $I->seeResponseCodeIs(400);
    }
}
