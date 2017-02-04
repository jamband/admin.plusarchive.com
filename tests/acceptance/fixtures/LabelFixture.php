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

use app\models\Label;
use yii\test\ActiveFixture;

class LabelFixture extends ActiveFixture
{
    public $modelClass = Label::class;

    public $dataFile = '@app/tests/acceptance/fixtures/data/label.php';
}
