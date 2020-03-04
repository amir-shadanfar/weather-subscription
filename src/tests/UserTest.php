<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    private function dummyData()
    {
        $insertedData = factory(\App\User::class)->make();
        $insertedData_array = $insertedData->attributesToArray();
        $insertedData_array['password'] = $insertedData->password;// this is hidden input
        return $insertedData_array;
    }

    /**
     * test user register
     */
    public function testUserRegister()
    {
        // create dummy data for test
        $dummy = $this->dummyData();
        $insertedModel = \App\User::create($dummy);
        $SelectedUser = \App\User::find($insertedModel->id);
        // assertions
        $this->assertInstanceOf(\App\User::class, $SelectedUser);
        $this->assertEquals($SelectedUser->email, $dummy['email']);
        $this->assertEquals($SelectedUser->language, $dummy['language']);
        $this->assertEquals($SelectedUser->timezone, $dummy['timezone']);
        $this->assertEquals($SelectedUser->operating_system, $dummy['operating_system']);
        $this->assertEquals($SelectedUser->access_token, $dummy['access_token']);
        $this->assertEquals($SelectedUser->plan_id, $dummy['plan_id']);
        $this->assertEquals($SelectedUser->gift_code_id, $dummy['gift_code_id']);
        $this->assertEquals($SelectedUser->city_id, $dummy['city_id']);
    }

    /**
     * test user update
     */
    public function testUserUpdate()
    {
        // create repo from models
        $dummy = $this->dummyData();
        $userCreated = \App\User::create($dummy);
        $dummy2 = $this->dummyData();
        // assertions
        $this->assertTrue($userCreated->update($dummy2));

        $updatedUser = \App\User::find($userCreated->id);

        $this->assertEquals($updatedUser->email, $dummy2['email']);
        $this->assertEquals($updatedUser->language, $dummy2['language']);
        $this->assertEquals($updatedUser->timezone, $dummy2['timezone']);
        $this->assertEquals($updatedUser->operating_system, $dummy2['operating_system']);
        $this->assertEquals($updatedUser->access_token, $dummy2['access_token']);
        $this->assertEquals($updatedUser->plan_id, $dummy2['plan_id']);
        $this->assertEquals($updatedUser->gift_code_id, $dummy2['gift_code_id']);
        $this->assertEquals($updatedUser->city_id, $dummy2['city_id']);
    }
}
