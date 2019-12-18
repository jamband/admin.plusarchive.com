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

namespace app\tests\unit\helpers;

use Yii;
use yii\base\Action;
use yii\helpers\Url;
use yii\web\Controller;
use Codeception\Test\Unit;

class UrlTest extends Unit
{
    public function testCurrentPlus(): void
    {
        Yii::$app->controller = new Controller('foo', Yii::$app);
        $controller = Yii::$app->controller;
        $controller->action = new Action('index', $controller);

        Yii::$app->request->setQueryParams(['page' => 10, 'q' => 'v1']);
        $this->assertSame('/index-test.php/foo/index?q=v1', Url::currentPlus());
        $this->assertSame('/index-test.php/foo/index?q=v2', Url::currentPlus(['q' => 'v2']));
        $this->assertSame('/index-test.php/foo/index', Url::currentPlus(['q' => null]));
    }
}
