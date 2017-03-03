<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\components;

use yii\helpers\Html;
use yii\i18n\Formatter as FormatterBase;

/**
 * {@inheritdoc}
 */
class Formatter extends FormatterBase
{
    /**
     * Formats the value as some hyperlink.
     * @param mixed $value the value to be formatted.
     * @param string $separator
     * @param string[] $domains some custom domain
     * @param array $options the tag options in terms of name-value pairs. See [[Html::a()]].
     * @return null|string the formatted result.
     */
    public function asSnsIconLink($value, $separator = null, array $domains = [], array $options = [])
    {
        if (null === $value || '' === $value) {
            return null;
        }
        if (null === $separator) {
            $separator = "\n";
        }
        $values = explode($separator, $value);
        sort($values, SORT_STRING);

        $urls = '';
        foreach ($values as $v) {
            $urls .= Html::a(static::getBrandIcon($v, $domains), $v, $options).' ';
        }
        return $urls;
    }

    /**
     * Get the brand icon for Font Awesome.
     * @param string $value
     * @param string[] $domains
     * @return string
     */
    private static function getBrandIcon($value, array $domains = [])
    {
        $icons = array_merge($domains, [
            'bandcamp.com' => 'bandcamp',
            'facebook.com' => 'facebook-square',
            'plus.google.com' => 'google-plus-square',
            'instagram.com' => 'instagram',
            'last.fm' => 'lastfm-square',
            'mixcloud.com' => 'mixcloud',
            'pinterest.com' => 'pinterest-square',
            'soundcloud.com' => 'soundcloud',
            'spotify.com' => 'spotify',
            'twitter.com' => 'twitter-square',
            'tumblr.com' => 'tumblr-square',
            'vimeo.com' => 'vimeo-square',
            'youtube.com' => 'youtube-square',
        ]);
        foreach ($icons as $domain => $icon) {
            if (false !== strpos($value, $domain)) {
                return '<i class="fa fa-'.$icon.' fa-fw fa-lg"></i>';
            }
        }
        return '<i class="fa fa-external-link fa-fw fa-lg"></i>';
    }
}
