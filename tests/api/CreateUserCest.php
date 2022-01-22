<?php

use Faker\Factory;

class CreateUserCest
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

    public function CreateUser(ApiTester $I)
    {

        // make request
        $I->sendPost('/user/create', [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->pass,

        ]);

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('"success":true');
        $I->seeResponseContainsJson(array('email' => $this->email));
        $I->seeResponseContainsJson(array('username' => $this->username));
        $I->seeResponseMatchesJsonType([
            'success' => 'boolean',
            'details' => [
                'username' => 'string',
                'email' => 'string:email',
                'password' => 'string',
                'created_at' => 'string',
                'updated_at' => 'string',
                'id' => 'integer'],
            'message' => 'string'
        ]);
    }
}
