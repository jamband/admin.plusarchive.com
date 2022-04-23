<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\TrackUpdateForm;
use app\models\Music;
use app\models\Track;
use app\tests\unit\fixtures\music\TrackUpdateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

/** @see TrackUpdateForm */
class TrackUpdateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSaveFails(): void
    {
        $fixtures['tracks'] = TrackUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $track1 = $this->tester->grabFixture('tracks', 'track1');

        $form = new TrackUpdateForm($track1->id);
        $form->url = 'https://example.com/foo/bar';
        $this->assertFalse($form->save());
    }

    public function testUrlUniqueValidation(): void
    {
        $fixtures['tracks'] = TrackUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $track1 = $this->tester->grabFixture('tracks', 'track1');
        $track2 = $this->tester->grabFixture('tracks', 'track2');

        $form = new TrackUpdateForm($track2->id);
        $form->url = $track1->url;
        $this->assertFalse($form->save());
        $this->assertTrue($form->hasErrors('url'));
    }

    public function testSave(): void
    {
        $fixtures['tracks'] = TrackUpdateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $track2 = $this->tester->grabFixture('tracks', 'track2');

        $form = new TrackUpdateForm($track2->id);
        $form->title = 'Updated Title';
        $form->tagValues = ['Folk', 'Rock'];
        $this->assertTrue($form->save());

        $track = Track::findOne(['title' => 'Updated Title']);

        $this->assertSame('https://www.youtube.com/watch?v=track2', $track->url);
        $this->assertSame(Music::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('track2', $track->provider_key);
        $this->assertSame('Updated Title', $track->title);
        $this->assertSame(Music::TYPE_TRACK, $track->type);
        $this->assertSame('http://dev.plusarchive:8080/assets/favicon.png', $track->image);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
        $this->assertSame(['Folk', 'Rock'], $track->tagValues);
    }
}
