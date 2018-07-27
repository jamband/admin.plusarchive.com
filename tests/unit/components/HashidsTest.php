<?php

/*
 * This file is part of the plusarchive.com
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
    const ID = 1;
    const HASH_ID = 'Xzr1XkpY';
    const MIN_HASH_LENGTH = 8;

    public function testMinHashLength(): void
    {
        $this->assertSame(self::MIN_HASH_LENGTH, strlen(Yii::$app->hashids->encode(self::ID)));
    }

    public function testEncode(): void
    {
        $this->assertSame(self::HASH_ID, Yii::$app->hashids->encode(self::ID));
    }

    public function testDecode(): void
    {
        $this->assertSame(self::ID, Yii::$app->hashids->decode(self::HASH_ID));
    }
}
