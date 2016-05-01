<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\codeception\unit\i18n;

use Yii;
use yii\codeception\TestCase;

class FormatterTest extends TestCase
{
    public function testAsSnsIconLink()
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://plus.google.com/+foo";

        $expected = '<a href="https://plus.google.com/+foo"><i class="fa fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo"><i class="fa fa-facebook-square fa-fw fa-lg"></i></a> ';

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
            ['<a href="https://www.instagram.com/foo/"><i class="fa fa-instagram fa-fw fa-lg"></i></a> ', 'https://www.instagram.com/foo/'],
            ['<a href="http://www.last.fm/foo"><i class="fa fa-lastfm-square fa-fw fa-lg"></i></a> ', 'http://www.last.fm/foo'],
            ['<a href="https://www.mixcloud.com/foo/"><i class="fa fa-mixcloud fa-fw fa-lg"></i></a> ', 'https://www.mixcloud.com/foo/'],
            ['<a href="https://www.pinterest.com/foo/"><i class="fa fa-pinterest-square fa-fw fa-lg"></i></a> ', 'https://www.pinterest.com/foo/'],
            ['<a href="https://soundcloud.com/foo"><i class="fa fa-soundcloud fa-fw fa-lg"></i></a> ', 'https://soundcloud.com/foo'],
            ['<a href="https://play.spotify.com/artist/foo"><i class="fa fa-spotify fa-fw fa-lg"></i></a> ', 'https://play.spotify.com/artist/foo'],
            ['<a href="https://twitter.com/foo"><i class="fa fa-twitter-square fa-fw fa-lg"></i></a> ', 'https://twitter.com/foo'],
            ['<a href="http://foo.tumblr.com"><i class="fa fa-tumblr-square fa-fw fa-lg"></i></a> ', 'http://foo.tumblr.com'],
            ['<a href="https://vimeo.com/channels/foo"><i class="fa fa-vimeo-square fa-fw fa-lg"></i></a> ', 'https://vimeo.com/channels/foo'],
            ['<a href="https://www.youtube.com/user/foo"><i class="fa fa-youtube-square fa-fw fa-lg"></i></a> ', 'https://www.youtube.com/user/foo'],
            ['<a href="https://www.example.com/foo"><i class="fa fa-external-link fa-fw fa-lg"></i></a> ', 'https://www.example.com/foo'],
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
        $expected = '<a href="https://plus.google.com/+foo"><i class="fa fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo"><i class="fa fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value, '|'));
    }

    public function testAsSnsIconLinkWithOptionsArgument()
    {
        $value = "https://www.facebook.com/foo\n";
        $value .= "https://plus.google.com/+foo";
        $expected = '<a href="https://plus.google.com/+foo" target="_blank"><i class="fa fa-google-plus-square fa-fw fa-lg"></i></a> ';
        $expected .= '<a href="https://www.facebook.com/foo" target="_blank"><i class="fa fa-facebook-square fa-fw fa-lg"></i></a> ';

        $this->assertSame($expected, Yii::$app->formatter->asSnsIconLink($value, null, ['target' => '_blank']));
    }
}
