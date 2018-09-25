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

namespace app\tests\unit\fixtures\bookmark;

use yii\test\ActiveFixture;

class BookmarkTagAssnFixture extends ActiveFixture
{
    public $tableName = 'bookmark_tag_assn';

    protected function getData(): array
    {
        return [
            'tag_assn1' => [
                'bookmark_id' => 1,
                'bookmark_tag_id' => 1,
            ],
        ];
    }
}
