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

namespace app\tests\acceptance\fixtures;

use app\models\LabelTag;
use yii\test\ActiveFixture;

class LabelTagFixture extends ActiveFixture
{
    public $modelClass = LabelTag::class;

    public $depends = [
        AdminUserFixture::class,
    ];

    protected function getData(): array
    {
        return [
            'tag1' => [
                'name' => 'tag1',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'tag2' => [
                'name' => 'tag2',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            'tag3' => [
                'name' => 'tag3',
                'frequency' => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
    }
}
