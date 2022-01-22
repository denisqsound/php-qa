<?php

class GetUsersCest
{
    public function GetUsers(ApiTester $I)
    {

        // make request
        $I->sendGet('/user/get');
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'username' => 'string',
            'email' => 'string',
            'password' => 'string',
            'created_at' => 'string',
            'updated_at' => 'string',
            'id' => 'integer'
        ]);
    }
}
