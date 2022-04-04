<?php

declare(strict_types=1);

namespace app\tests\unit\models;

use app\models\Label;
use app\tests\unit\fixtures\label\LabelAllFixture;
use Codeception\Test\Unit;
use UnitTester;

class LabelTest extends Unit
{
    protected UnitTester $tester;

    public function testAll(): void
    {
        $fixtures['labels'] = LabelAllFixture::class;
        $this->tester->haveFixtures($fixtures);

        // no parameters
        $labels = Label::all()->models;
        $this->assertSame(4, count($labels));
        $this->assertSame('label2', $labels[0]->name);

        $this->assertSame(1, count($labels[1]->tags));
        $this->assertSame('tag1', $labels[1]->tags[0]->name);

        // sort=Name
        $labels = Label::all('Name')->models;
        $this->assertSame(4, count($labels));
        $this->assertSame('label1', $labels[0]->name);

        // country=Japan
        $labels = Label::all(null, 'Japan')->models;
        $this->assertSame(2, count($labels));
        $this->assertSame('label1', $labels[0]->name);
        $this->assertSame('label4', $labels[1]->name);

        // tag=tag1
        $labels = Label::all(null, null, 'tag1')->models;
        $this->assertSame(1, count($labels));
        $this->assertSame('label1', $labels[0]->name);

        // country=Japan&tag=tag2
        $labels = Label::all(null, 'Japan', 'tag2')->models;
        $this->assertSame(0, count($labels));

        // search=3
        $labels = Label::all(null, null, null, '3')->models;
        $this->assertSame(1, count($labels));
        $this->assertSame('label3', $labels[0]->name);
    }
}
