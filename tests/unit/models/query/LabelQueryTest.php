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

namespace app\tests\unit\models\query;

use app\models\Label;
use app\tests\unit\fixtures\label\LabelQueryBehaviorsFixture;
use app\tests\unit\fixtures\label\LabelQueryCountryFixture;
use app\tests\unit\fixtures\label\LabelQueryInNameOrderFixture;
use app\tests\unit\fixtures\label\LabelQuerySearchFixture;
use app\tests\unit\fixtures\label\LabelQuerySortFixture;
use Codeception\Test\Unit;

class LabelQueryTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testBehaviors(): void
    {
        $this->tester->haveFixtures([
            LabelQueryBehaviorsFixture::class,
        ]);

        $labels = Label::find()->allTagValues('tag1')->all();
        $this->assertSame(1, count($labels));
        $this->assertSame('label1', $labels[0]->name);
    }

    public function testCountry(): void
    {
        $this->tester->haveFixtures([
            LabelQueryCountryFixture::class,
        ]);

        $labels = Label::find()->country(null)->all();
        $this->assertSame(4, count($labels));

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
        $this->tester->haveFixtures([
            LabelQuerySearchFixture::class,
        ]);

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
        $this->tester->haveFixtures([
            LabelQueryInNameOrderFixture::class,
        ]);

        $labels = Label::find()->inNameOrder()->all();
        $this->assertSame(3, count($labels));
        $this->assertSame('bar', $labels[0]->name);
        $this->assertSame('baz', $labels[1]->name);
        $this->assertSame('foo', $labels[2]->name);
    }

    public function testSort(): void
    {
        $this->tester->haveFixtures([
            labelQuerySortFixture::class,
        ]);

        $labels = Label::find()->sort('Name')->all();
        $this->assertSame(3, count($labels));
        $this->assertSame('bar', $labels[0]->name);
        $this->assertSame('baz', $labels[1]->name);
        $this->assertSame('foo', $labels[2]->name);

        $labels = Label::find()->sort('Foo')->all();
        $this->assertSame(3, count($labels));
        $this->assertSame('foo', $labels[0]->name);
        $this->assertSame('baz', $labels[1]->name);
        $this->assertSame('bar', $labels[2]->name);

        $labels = Label::find()->sort(null)->all();
        $this->assertSame(3, count($labels));
        $this->assertSame('foo', $labels[0]->name);
        $this->assertSame('baz', $labels[1]->name);
        $this->assertSame('bar', $labels[2]->name);
    }
}
