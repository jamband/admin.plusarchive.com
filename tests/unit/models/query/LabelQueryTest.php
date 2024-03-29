<?php

declare(strict_types=1);

namespace app\tests\unit\models\query;

use app\models\Label;
use app\models\query\LabelQuery;
use app\tests\unit\fixtures\label\LabelQueryBehaviorsFixture;
use app\tests\unit\fixtures\label\LabelQueryCountryFixture;
use app\tests\unit\fixtures\label\LabelQueryInNameOrderFixture;
use app\tests\unit\fixtures\label\LabelQueryLatestFixture;
use app\tests\unit\fixtures\label\LabelQuerySearchFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see LabelQuery */
class LabelQueryTest extends Unit
{
    protected UnitTester $tester;

    public function testBehaviors(): void
    {
        $fixtures['labels'] = LabelQueryBehaviorsFixture::class;
        $this->tester->haveFixtures($fixtures);

        $labels = Label::find()->allTagValues('tag1')->all();
        $this->assertSame(1, count($labels));
        $this->assertSame('label1', $labels[0]->name);
    }

    public function testCountry(): void
    {
        $fixtures['labels'] = LabelQueryCountryFixture::class;
        $this->tester->haveFixtures($fixtures);

        $labels = Label::find()->country(null)->all();
        $this->assertSame(0, count($labels));

        $labels = Label::find()->country('Foo')->all();
        $this->assertSame(0, count($labels));

        $labels = Label::find()->country('Japan')->all();
        $this->assertSame(2, count($labels));
        $this->assertSame('Japan', $labels[0]->country);
        $this->assertSame('Japan', $labels[1]->country);

        $labels = Label::find()->country('US')->all();
        $this->assertSame(1, count($labels));
        $this->assertSame('US', $labels[0]->country);
    }

    public function testSearch(): void
    {
        $fixtures['labels'] = LabelQuerySearchFixture::class;
        $this->tester->haveFixtures($fixtures);

        $labels = Label::find()->search('')->all();
        $this->assertSame(3, count($labels));

        $labels = Label::find()->search('fo')->all();
        $this->assertSame(1, count($labels));
        $this->assertSame('foo', $labels[0]->name);

        $labels = Label::find()->search('ba')->orderBy(['name' => SORT_ASC])->all();
        $this->assertSame(2, count($labels));
        $this->assertSame('bar', $labels[0]->name);
        $this->assertSame('baz', $labels[1]->name);

        $labels = Label::find()->search('cloud')->orderBy(['name' => SORT_ASC])->all();
        $this->assertSame(2, count($labels));
        $this->assertSame('baz', $labels[0]->name);
        $this->assertSame('foo', $labels[1]->name);
    }

    public function testInNameOrder(): void
    {
        $fixtures['labels'] = LabelQueryInNameOrderFixture::class;
        $this->tester->haveFixtures($fixtures);

        $labels = Label::find()->inNameOrder()->all();
        $this->assertSame(3, count($labels));
        $this->assertSame('bar', $labels[0]->name);
        $this->assertSame('baz', $labels[1]->name);
        $this->assertSame('foo', $labels[2]->name);
    }

    public function testLatest(): void
    {
        $fixtures['labels'] = LabelQueryLatestFixture::class;
        $this->tester->haveFixtures($fixtures);

        $labels = Label::find()->latest()->all();
        $this->assertSame(3, count($labels));
        $this->assertSame('label1', $labels[0]->name);
        $this->assertSame('label3', $labels[1]->name);
        $this->assertSame('label2', $labels[2]->name);
    }
}
