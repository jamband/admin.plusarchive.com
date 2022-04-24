<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Label;
use app\models\query\LabelQuery;
use Codeception\Test\Unit;
use UnitTester;

/** @see Label */
class LabelTest extends Unit
{
    protected UnitTester $tester;

    public function testFind(): void
    {
        $this->assertInstanceOf(LabelQuery::class, Label::find());
    }
}
