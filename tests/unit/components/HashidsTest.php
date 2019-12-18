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

namespace app\tests\unit\components;

use Yii;
use Codeception\Test\Unit;

class HashidsTest extends Unit
{
    public function testMinHashLength(): void
    {
        $this->assertSame(8, strlen(Yii::$app->hashids->encode(1)));
    }

    public function testEncode(): void
    {
        $this->assertSame('Xzr1XkpY', Yii::$app->hashids->encode(1));
    }

    public function testDecode(): void
    {
        $this->assertSame(0, Yii::$app->hashids->decode('fakeHash'));
        $this->assertSame(1, Yii::$app->hashids->decode('Xzr1XkpY'));
    }
}
