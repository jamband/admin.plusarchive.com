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
use app\models\form\TrackUpdateForm;
use app\tests\unit\fixtures\music\TrackUpdateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class TrackUpdateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSave(): void
    {
        $fixtures['tracks'] = TrackUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $tracks = $this->tester->grabFixture('tracks');

        // invalid
        $form = new TrackUpdateForm(2);
        $form->url = 'https://example.com/foo/bar';
        $this->assertFalse($form->save());

        // invalid: unique validation
        $form = new TrackUpdateForm(2);
        $form->url = $tracks['track1']['url'];
        $this->assertFalse($form->save());
        $this->assertTrue($form->hasErrors('url'));

        // valid
        $form = new TrackUpdateForm(2);
        $form->title = 'Updated Title';
        $form->tagValues = ['Folk', 'Rock'];
        $this->assertTrue($form->save());

        $track = Track::findOne(['title' => 'Updated Title']);

        $this->assertSame('https://www.youtube.com/watch?v=track2', $track->url);
        $this->assertSame(Track::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('track2', $track->provider_key);
        $this->assertSame('Updated Title', $track->title);
        $this->assertSame(Track::TYPE_TRACK, $track->type);
        $this->assertSame('http://dev.plusarchive:8080/assets/favicon.png', $track->image);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
        $this->assertSame(['Folk', 'Rock'], $track->tagValues);
    }
}
