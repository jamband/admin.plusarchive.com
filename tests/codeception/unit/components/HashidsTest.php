<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace test\codeception\unit\components;

use Yii;
use app\components\Hashids;
use yii\codeception\TestCase;

class HashidsTest extends TestCase
{
    const ID = 1;
    const HASH_ID = 'Xzr1XkpY';
    const MIN_HASH_LENGTH = 8;

    protected function setUp()
    {
        parent::setUp();

        Yii::$app->set('hashids', [
            'class' => Hashids::class,
            'salt' => 'testsalt',
            'minHashLength' => 8,
            'alphabet' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-',
        ]);
    }

    public function testMinHashLength()
    {
        $this->assertSame(self::MIN_HASH_LENGTH, strlen(Yii::$app->hashids->encode(self::ID)));
    }

    public function testEncode()
    {
        $this->assertSame(self::HASH_ID, Yii::$app->hashids->encode(self::ID));
    }

    public function testDecode()
    {
        $this->assertSame(self::ID, Yii::$app->hashids->decode(self::HASH_ID));
    }
}
