<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\tests\unit\components;

use Yii;
use Codeception\Test\Unit;

class FormatterTest extends Unit
{
    public function testAsSnsIconLink()
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://plus.google.com/+foo";

        $expected = '<a href="https://plus.google.com/+foo"><i class="fab fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value));
    }

    /**
     * @param string $expected
     * @param string $value
     * @dataProvider asSnsIconLinkProvider
     */
    public function testAsSnsIconLinks($expected, $value)
    {
        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value));
    }

    public function asSnsIconLinkProvider()
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
        ];
    }

    public function testAsSnsIconLinkEmptyValue()
    {
        $this->assertNull(Yii::$app->formatter->asSnsIconLink(null));
        $this->assertNull(Yii::$app->formatter->asSnsIconLink(''));
    }

    public function testAsSnsIconLinkWithSeparatorArgument()
    {
        $value = 'https://www.facebook.com/foo|https://plus.google.com/+foo';
        $expected = '<a href="https://plus.google.com/+foo"><i class="fab fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value, '|'));
    }

    public function testAsSnsIconLinkWithDomainsArgument()
    {
        $value = "http://music.botanicalhouse.net\n";
        $value .= "http://souterraine.biz";
        $expected = '<a href="http://music.botanicalhouse.net"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="http://souterraine.biz"><i class="fab fa-bandcamp fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value, null, custom_domains()));
    }

    public function testAsSnsIconLinkWithOptionsArgument()
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://plus.google.com/+foo";
        $expected = '<a href="https://plus.google.com/+foo" target="_blank"><i class="fab fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo" target="_blank"><i class="fab fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value, null, [], ['target' => '_blank']));
    }
}
