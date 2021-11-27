<?php

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\TrackCreateForm;
use app\models\Music;
use app\models\Track;
use app\tests\unit\fixtures\music\TrackCreateFormFixture;
use Codeception\Test\Unit;
use UnitTester;

class TrackCreateFormTest extends Unit
{
    protected UnitTester $tester;

    public function testSaveFails(): void
    {
        $model = new TrackCreateForm;
        $model->url = 'https://example.com/foo/bar';
        $this->assertFalse($model->save());
    }

    public function testUrlUniqueValidation(): void
    {
        $fixtures['tracks'] = TrackCreateFormFixture::class;
        $this->tester->haveFixtures($fixtures);
        $track1 = $this->tester->grabFixture('tracks', 'track1');

        $model = new TrackCreateForm;
        $model->url = $track1->url;
        $this->assertFalse($model->save());
        $this->assertTrue($model->hasErrors('url'));
    }

    public function testSave(): void
    {
        $model = new TrackCreateForm;
        $model->url = 'https://www.youtube.com/watch?v=foo';
        $model->tagValues = ['Folk', 'Rock'];
        $this->assertTrue($model->save());

        $track = Track::findOne(['title' => 'Foo Title']);

        $this->assertSame('https://www.youtube.com/watch?v=foo', $track->url);
        $this->assertSame(Music::PROVIDER_YOUTUBE, $track->provider);
        $this->assertSame('foo', $track->provider_key);
        $this->assertSame('Foo Title', $track->title);
        $this->assertSame('http://dev.plusarchive:8080/assets/apple-touch-icon.png', $track->image);
        $this->assertSame(Music::TYPE_TRACK, $track->type);
        $this->assertSame(0, $track->urge);
        $this->assertGreaterThanOrEqual(time(), $track->created_at);
        $this->assertGreaterThanOrEqual(time(), $track->updated_at);
        $this->assertSame(['Folk', 'Rock'], $track->tagValues);
    }
}
