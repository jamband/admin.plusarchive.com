<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\models\form;

use app\models\form\SignupForm;
use app\models\User;
use tests\codeception\unit\fixtures\UserFixture;
use yii\codeception\DbTestCase;

class SignupFormTest extends DbTestCase
{
    public function fixtures()
    {
        return [
            'user' => UserFixture::class,
        ];
    }

    public function testSignupFailure()
    {
        $model = new SignupForm();
        $this->assertNull($model->signup());
        $this->assertNotEmpty($model->errors);
    }

    public function testSignupSuccess()
    {
        $model = new SignupForm([
            'username' => 'newuser',
            'email' => 'newuser@example.com',
            'password' => 'newusernewuser',
        ]);
        $this->assertInstanceOf(User::class, $model->signup());
        $this->assertEmpty($model->errors);
    }
}
