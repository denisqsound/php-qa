<?php

use Faker\Factory;

class GetUsersCest
{

    protected $username;
    protected $email;
    protected $pass;

    public function _before(ApiTester $I)
    {
        // Create fake data
        $faker = Factory::create();
        $this->username = $faker->firstNameMale() . strtotime("now");
        $this->email = $faker->email();
        $this->pass = $faker->password();
    }

    public function GetUsers(ApiTester $I)
    {
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

    public function GetCreatedUser(ApiTester $I)
    {
        // create user
        $I->sendPost('/user/create', [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->pass,

        ]);

        // get created user
        $I->sendGet('/user/get');

        // check
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseContains($this->username);
        $I->seeResponseContains($this->email);

    }
}
