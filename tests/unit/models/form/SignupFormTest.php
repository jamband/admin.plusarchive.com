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

    public function testSignup(): void
    {
        $fixtures['users'] = SignupFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $users = $this->tester->grabFixture('users');

        // failure
        $model = new SignupForm;
        $model->username = $users['user1']['username']; // not unique
        $model->email = 'new_user@example.com';
        $model->password = 'new_user_password';

        $this->assertNull($model->signup());
        $this->assertNotEmpty($model->getErrors('username'));

        // success
        $model = new SignupForm;
        $model->username = 'new_user';
        $model->email = 'new_user@example.com';
        $model->password = 'new_user_password';

        $this->assertInstanceOf(User::class, $model->signup());
        $this->assertEmpty($model->errors);
    }
}
