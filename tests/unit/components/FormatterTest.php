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

namespace app\tests\unit\components;

use Yii;
use Codeception\Test\Unit;

class FormatterTest extends Unit
{
    public function testAsTagValues(): void
    {
        $this->assertSame('', Yii::$app->formatter->asTagValues(null));
        $this->assertSame('foo, bar', Yii::$app->formatter->asTagValues('foo, bar'));
        $this->assertSame('foo, bar', Yii::$app->formatter->asTagValues(['foo', 'bar']));
        $this->assertSame("foo&#039;s, bar&#039;s", Yii::$app->formatter->asTagValues("foo's, bar's"));
        $this->assertSame("foo&#039;s, bar&#039;s", Yii::$app->formatter->asTagValues(["foo's", "bar's"]));
    }

    public function testAsUrlWithText(): void
    {
        $value = 'https://example.com';
        $expected = '<a href="https://example.com" rel="noopener" target="_blank"><i class="fas fa-external-link-alt fa-fw"></i> https://example.com</a>';
        $this->assertSame($expected, Yii::$app->formatter->asUrlWithText($value));

        $value = 'https://example.com';
        $expected = '<a href="https://example.com" rel="noopener" target="_blank"><i class="fas fa-external-link-alt fa-fw"></i> Example&#039;s</a>';
        $this->assertSame($expected, Yii::$app->formatter->asUrlWithText($value, "Example's"));

        $value = 'https://example.com';
        $expected = '<a class="foo" href="https://example.com" rel="noopener" target="_blank"><i class="fas fa-external-link-alt fa-fw"></i> Example&#039;s</a>';
        $this->assertSame($expected, Yii::$app->formatter->asUrlWithText($value, "Example's", ['class' => 'foo']));

        $this->assertSame(Yii::$app->formatter->nullDisplay, Yii::$app->formatter->asUrlWithText(null));
    }

    public function testAsSnsIconLink(): void
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://twitter.com/foo";

        $expected = '<a href="https://twitter.com/foo" rel="noopener" target="_blank"><i class="fab fa-twitter-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo" rel="noopener" target="_blank"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asBrandIconLink($value));
    }

    /**
     * @param string $expected
     * @param string $value
     * @return void
     * @dataProvider asSnsIconLinkProvider
     */
    public function testAsSnsIconLinks(string $expected, string $value): void
    {
        $this->assertSame($expected, Yii::$app->formatter->asBrandIconLink($value));
    }

    public function asSnsIconLinkProvider(): array
    {
        return [
            ['<a href="https://foo.bandcamp.com" rel="noopener" target="_blank"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://foo.bandcamp.com'],
            ['<a href="https://www.instagram.com/foo/" rel="noopener" target="_blank"><i class="fab fa-instagram fa-fw fa-lg"></i></a> ', 'https://www.instagram.com/foo/'],
            ['<a href="https://www.last.fm/foo" rel="noopener" target="_blank"><i class="fab fa-lastfm-square fa-fw fa-lg"></i></a> ', 'https://www.last.fm/foo'],
            ['<a href="https://www.mixcloud.com/foo/" rel="noopener" target="_blank"><i class="fab fa-mixcloud fa-fw fa-lg"></i></a> ', 'https://www.mixcloud.com/foo/'],
            ['<a href="https://www.pinterest.com/foo/" rel="noopener" target="_blank"><i class="fab fa-pinterest-square fa-fw fa-lg"></i></a> ', 'https://www.pinterest.com/foo/'],
            ['<a href="https://soundcloud.com/foo" rel="noopener" target="_blank"><i class="fab fa-soundcloud fa-fw fa-lg"></i></a> ', 'https://soundcloud.com/foo'],
            ['<a href="https://play.spotify.com/artist/foo" rel="noopener" target="_blank"><i class="fab fa-spotify fa-fw fa-lg"></i></a> ', 'https://play.spotify.com/artist/foo'],
            ['<a href="https://twitter.com/foo" rel="noopener" target="_blank"><i class="fab fa-twitter-square fa-fw fa-lg"></i></a> ', 'https://twitter.com/foo'],
            ['<a href="https://foo.tumblr.com" rel="noopener" target="_blank"><i class="fab fa-tumblr-square fa-fw fa-lg"></i></a> ', 'https://foo.tumblr.com'],
            ['<a href="https://vimeo.com/channels/foo" rel="noopener" target="_blank"><i class="fab fa-vimeo-square fa-fw fa-lg"></i></a> ', 'https://vimeo.com/channels/foo'],
            ['<a href="https://www.youtube.com/user/foo" rel="noopener" target="_blank"><i class="fab fa-youtube-square fa-fw fa-lg"></i></a> ', 'https://www.youtube.com/user/foo'],
            ['<a href="https://www.example.com/foo" rel="noopener" target="_blank"><i class="fas fa-external-link-alt fa-fw fa-lg"></i></a> ', 'https://www.example.com/foo'],

            // Bandcamp hosts
            ['<a href="https://shop.fikarecordings.com" rel="noopener" target="_blank"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://shop.fikarecordings.com'],
            ['<a href="https://tunes.mamabirdrecordingco.com" rel="noopener" target="_blank"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://tunes.mamabirdrecordingco.com'],
            ['<a href="https://downloads.maybemars.org" rel="noopener" target="_blank"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://downloads.maybemars.org'],
            ['<a href="https://souterraine.biz" rel="noopener" target="_blank"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://souterraine.biz'],
        ];
    }

    public function testAsSnsIconLinkEmptyValue(): void
    {
        $this->assertNull(Yii::$app->formatter->asBrandIconLink(null));
        $this->assertNull(Yii::$app->formatter->asBrandIconLink(''));
    }

    public function testAsSnsIconLinkWithSeparatorArgument(): void
    {
        $value = 'https://www.facebook.com/foo|https://twitter.com/foo';
        $expected = '<a href="https://twitter.com/foo" rel="noopener" target="_blank"><i class="fab fa-twitter-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo" rel="noopener" target="_blank"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asBrandIconLink($value, '|'));
    }

    public function testAsSnsIconLinkWithOptionsArgument(): void
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://twitter.com/foo";
        $expected = '<a class="foo" href="https://twitter.com/foo" rel="noopener" target="_blank"><i class="fab fa-twitter-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a class="foo" href="https://www.facebook.com/foo" rel="noopener" target="_blank"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asBrandIconLink($value, null, ['class' => 'foo']));
    }
}
