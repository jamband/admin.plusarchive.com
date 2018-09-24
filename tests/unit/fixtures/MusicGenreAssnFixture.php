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

namespace app\tests\unit\fixtures;

use yii\test\ActiveFixture;

class MusicGenreAssnFixture extends ActiveFixture
{
    public $tableName = 'music_genre_assn';

    protected function getData(): array
    {
        return [
            'genre_assn1' => [
                'music_id' => 1,
                'music_genre_id' => 1,
            ],
        ];
    }
}
