<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\acceptance\fixtures;

use app\models\LabelTag;
use yii\test\ActiveFixture;

class LabelTagFixture extends ActiveFixture
{
    public $modelClass = LabelTag::class;

    public $dataFile = '@fixture/label_tag.php';

    public $depends = [
        UserFixture::class,
    ];
}
