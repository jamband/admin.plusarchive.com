<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\LoginForm;
use app\tests\unit\fixtures\auth\LoginFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class LoginFormTest extends Unit
{
    protected UnitTester $tester;

    public function testLogin(): void
    {
        $fixtures['users'] = LoginFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $users = $this->tester->grabFixture('users');

        // failure
        $model = new LoginForm;
        $model->username = 'foo';
        $model->password = 'bar';

        $this->assertFalse($model->login());
        $this->assertNotEmpty($model->errors);
        $this->assertTrue(user()->isGuest);

        // success
        $model = new LoginForm;
        $model->username = $users['user1']['username'];
        $model->password = str_repeat($users['user1']['username'], 2);

        $this->assertTrue($model->login());
        $this->assertEmpty($model->errors);
        $this->assertFalse(user()->isGuest);
    }
}
