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

namespace app\tests\unit\fixtures\store;

use yii\test\ActiveFixture;

class StoreTagAssnFixture extends ActiveFixture
{
    public $tableName = 'store_tag_assn';

    protected function getData(): array
    {
        return [
            'tag_assn1' => [
                'store_id' => 1,
                'store_tag_id' => 1,
            ],
        ];
    }
}
