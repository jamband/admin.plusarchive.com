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

namespace app\tests\unit\components;

use Yii;
use Codeception\Test\Unit;

class FormatterTest extends Unit
{
    public function testAsSnsIconLink(): void
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://plus.google.com/+foo";

        $expected = '<a href="https://plus.google.com/+foo"><i class="fab fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

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
            ['<a href="https://foo.bandcamp.com"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://foo.bandcamp.com'],
            ['<a href="https://www.instagram.com/foo/"><i class="fab fa-instagram fa-fw fa-lg"></i></a> ', 'https://www.instagram.com/foo/'],
            ['<a href="http://www.last.fm/foo"><i class="fab fa-lastfm-square fa-fw fa-lg"></i></a> ', 'http://www.last.fm/foo'],
            ['<a href="https://www.mixcloud.com/foo/"><i class="fab fa-mixcloud fa-fw fa-lg"></i></a> ', 'https://www.mixcloud.com/foo/'],
            ['<a href="https://www.pinterest.com/foo/"><i class="fab fa-pinterest-square fa-fw fa-lg"></i></a> ', 'https://www.pinterest.com/foo/'],
            ['<a href="https://soundcloud.com/foo"><i class="fab fa-soundcloud fa-fw fa-lg"></i></a> ', 'https://soundcloud.com/foo'],
            ['<a href="https://play.spotify.com/artist/foo"><i class="fab fa-spotify fa-fw fa-lg"></i></a> ', 'https://play.spotify.com/artist/foo'],
            ['<a href="https://twitter.com/foo"><i class="fab fa-twitter-square fa-fw fa-lg"></i></a> ', 'https://twitter.com/foo'],
            ['<a href="http://foo.tumblr.com"><i class="fab fa-tumblr-square fa-fw fa-lg"></i></a> ', 'http://foo.tumblr.com'],
            ['<a href="https://vimeo.com/channels/foo"><i class="fab fa-vimeo-square fa-fw fa-lg"></i></a> ', 'https://vimeo.com/channels/foo'],
            ['<a href="https://www.youtube.com/user/foo"><i class="fab fa-youtube-square fa-fw fa-lg"></i></a> ', 'https://www.youtube.com/user/foo'],
            ['<a href="https://www.example.com/foo"><i class="fas fa-external-link-alt fa-fw fa-lg"></i></a> ', 'https://www.example.com/foo'],

            // Bandcamp hosts
            ['<a href="https://shop.fikarecordings.com"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://shop.fikarecordings.com'],
            ['<a href="https://tunes.mamabirdrecordingco.com"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://tunes.mamabirdrecordingco.com'],
            ['<a href="https://downloads.maybemars.org"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://downloads.maybemars.org'],
            ['<a href="https://souterraine.biz"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ', 'https://souterraine.biz'],
        ];
    }

    public function testAsSnsIconLinkEmptyValue(): void
    {
        $this->assertNull(Yii::$app->formatter->asBrandIconLink(null));
        $this->assertNull(Yii::$app->formatter->asBrandIconLink(''));
    }

    public function testAsSnsIconLinkWithSeparatorArgument(): void
    {
        $value = 'https://www.facebook.com/foo|https://plus.google.com/+foo';
        $expected = '<a href="https://plus.google.com/+foo"><i class="fab fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asBrandIconLink($value, '|'));
    }

    public function testAsSnsIconLinkWithOptionsArgument(): void
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://plus.google.com/+foo";
        $expected = '<a href="https://plus.google.com/+foo" target="_blank"><i class="fab fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo" target="_blank"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asBrandIconLink($value, null, ['target' => '_blank']));
    }
}
