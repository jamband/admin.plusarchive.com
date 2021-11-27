<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\SignupForm;
use app\models\User;
use app\tests\unit\fixtures\auth\SignupFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class SignupFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSignupFails(): void
    {
        $model = new SignupForm;
        $this->assertNull($model->signup());
    }

    public function testUsernameUniqueValidation(): void
    {
        $fixtures['users'] = SignupFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $user1 = $this->tester->grabFixture('users', 'user1');

        $model = new SignupForm;
        $model->username = $user1->username;

        $this->assertNull($model->signup());
        $this->assertNotEmpty($model->getErrors('username'));
    }

    public function testSignup(): void
    {
        $model = new SignupForm;
        $model->username = 'new_user';
        $model->email = 'new_user@example.com';
        $model->password = str_repeat('new_user', 2);

        $this->assertInstanceOf(User::class, $model->signup());
        $this->assertEmpty($model->errors);
    }
}
