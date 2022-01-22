<?php

use Faker\Factory;

class CreateUserCest
{

    public function CreateUser(ApiTester $I)
    {

        // Create fake data
        $faker = Factory::create();
        $username = $faker->firstNameMale();
        $email = $faker->email();
        $pass = $faker->password();

        // make request
        $I->sendPost('/user/create', [
            'username' => $username,
            'email' => $email,
            'password' => $pass,

        ]);

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContains('"success":true');
//        $I->seeResponseContains($username,$email,$pass,'qwe');
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
