<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\LoginForm;
use app\tests\unit\fixtures\auth\LoginFormFixture;
use Codeception\Test\Unit;
use UnitTester;
use Yii;

/** @see LoginForm */
class LoginFormTest extends Unit
{
    protected UnitTester $tester;

    public function testLoginFails(): void
    {
        $fixtures['users'] = LoginFormFixture::class;
        $this->tester->haveFixtures($fixtures);

        $model = new LoginForm();
        $model->username = 'foo';
        $model->password = 'bar';

        $this->assertFalse($model->login());
        $this->assertNotEmpty($model->errors);
        $this->assertTrue(Yii::$app->user->isGuest);
    }

    public function testLogin(): void
    {
        $fixtures['users'] = LoginFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $user = $this->tester->grabFixture('users', 'user1');

        $model = new LoginForm();
        $model->username = $user['username'];
        $model->password = str_repeat($user['username'], 2);

        $this->assertTrue($model->login());
        $this->assertEmpty($model->errors);
        $this->assertFalse(Yii::$app->user->isGuest);
    }
}
