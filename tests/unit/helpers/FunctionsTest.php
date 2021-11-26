<?php

declare(strict_types=1);

namespace app\tests\unit\helpers;

use Codeception\Test\Unit;
use Yii;

class FunctionsTest extends Unit
{
    public function testApp(): void
    {
        $this->assertSame(Yii::$app, app());
    }

    public function testDb(): void
    {
        $this->assertSame(Yii::$app->getDb(), db());
    }

    public function testFormatter(): void
    {
        $this->assertSame(Yii::$app->getFormatter(), formatter());
    }

    public function testRequest(): void
    {
        $this->assertSame(Yii::$app->getRequest(), request());
    }

    public function testResponse(): void
    {
        $this->assertSame(Yii::$app->getResponse(), response());
    }

    public function testSession(): void
    {
        $this->assertSame(Yii::$app->getSession(), session());
    }

    public function testSecurity(): void
    {
        $this->assertSame(Yii::$app->getSecurity(), security());
    }

    public function testUser(): void
    {
        $this->assertSame(Yii::$app->getUser(), user());
    }

    public function testHashids(): void
    {
        $this->assertSame(Yii::$app->hashids, hashids());
    }

    public function testUrl(): void
    {
        $this->assertSame('/index-test.php/foo/index?q=bar', url(['/foo/index', 'q' => 'bar']));
    }

    public function testH(): void
    {
        $this->assertSame('&lt;script&gt;alert(&#039;xss&#039;);&lt;/script&gt;', h("<script>alert('xss');</script>"));
    }

    public function testAsset(): void
    {
        $this->assertTrue((bool)preg_match('#\A/assets/app\.[0-9a-f]+\.css\z#', asset('app.css')));
        $this->assertTrue((bool)preg_match('#\A/assets/app\.[0-9a-f]+\.js\z#', asset('app.js')));
        $this->assertTrue((bool)preg_match('#\A/assets/favicon\.png\z#', asset('favicon.png')));
        $this->assertTrue((bool)preg_match('#\A/assets/apple-touch-icon\.png\z#', asset('apple-touch-icon.png')));

        $this->assertSame('/assets/foo.css', asset('foo.css'));

    }
}
