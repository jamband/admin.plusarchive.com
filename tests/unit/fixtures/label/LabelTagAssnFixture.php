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

namespace app\tests\unit\fixtures\label;

use yii\test\ActiveFixture;

class LabelTagAssnFixture extends ActiveFixture
{
    public $tableName = 'label_tag_assn';

    protected function getData(): array
    {
        return [
            'tag_assn1' => [
                'label_id' => 1,
                'label_tag_id' => 1,
            ],
        ];
    }
}
