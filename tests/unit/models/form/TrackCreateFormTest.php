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

namespace app\tests\unit\models\form;

use app\models\Track;
use app\models\form\TrackCreateForm;
use app\tests\unit\fixtures\music\TrackCreateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class TrackCreateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSave(): void
    {
        $fixtures['tracks'] = TrackCreateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $tracks = $this->tester->grabFixture('tracks');

        // invalid
        $form = new TrackCreateForm;
        $form->url = 'https://example.com/foo/bar';
        $this->assertFalse($form->save());

        // invalid: unique validation
        $form = new TrackCreateForm;
        $form->url = $tracks['track1']['url'];
        $this->assertFalse($form->save());
        $this->assertTrue($form->hasErrors('url'));

        // valid
        $form = new TrackCreateForm;
        $form->url = 'https://www.youtube.com/watch?v=foo';
        $form->tagValues = ['Folk', 'Rock'];
        $this->assertTrue($form->save());

        $track = Track::findOne(['title' => 'Foo Title']);

        $this->assertSame('https://www.youtube.com/watch?v=foo', $track->url);
        $this->assertSame(Track::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('foo', $track->provider_key);
        $this->assertSame('Foo Title', $track->title);
        $this->assertSame('http://dev.plusarchive:8080/assets/apple-touch-icon.png', $track->image);
        $this->assertSame(Track::TYPE_TRACK, $track->type);
        $this->assertSame(0, $track->urge);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
        $this->assertSame(['Folk', 'Rock'], $track->tagValues);
    }
}
