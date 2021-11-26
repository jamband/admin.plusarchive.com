<?php

declare(strict_types=1);

namespace app\components;

use JetBrains\PhpStorm\Pure;
use yii\helpers\Html;
use yii\i18n\Formatter as FormatterBase;

class Formatter extends FormatterBase
{
    private const EXTERNAL_LINK_DEFAULT_OPTIONS = [
        'rel' => 'noopener',
        'target' => '_blank',
    ];

    public function asTagValues(string|array|null $value): string
    {
        if ('' === $value || empty($value)) {
            return '';
        }

        if (is_array($value)) {
            $value = implode(', ', $value);
        }

        return Html::encode($value);
    }

    public function asUrlWithText(
        string|null $value,
        string|null $text = null,
        array $options = []
    ): string {
        if (null === $value) {
            return $this->nullDisplay;
        }

        if (null === $text) {
            $text = $value;
        }

        $options += self::EXTERNAL_LINK_DEFAULT_OPTIONS;

        return Html::a('<i class="fas fa-external-link-alt fa-fw"></i> '.Html::encode($text), $value, $options);
    }

    public function asBrandIconLink(
        string|null $value,
        string|null $separator = null,
        array $options = []
    ): string|null {
        if (null === $value || '' === $value) {
            return null;
        }

        if (null === $separator) {
            $separator = "\n";
        }

        $values = explode($separator, $value);
        sort($values, SORT_STRING);

        $urls = '';

        $options += self::EXTERNAL_LINK_DEFAULT_OPTIONS;

        foreach ($values as $v) {
            $urls .= Html::a(static::getBrandIcon($v), $v, $options).' ';
        }

        return $urls;
    }

    private static function getBrandIcon(string $value): string
    {
        $icons = [
            'bandcamp.com' => 'bandcamp',
            'facebook.com' => 'facebook-square',
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
        ];

        // Bandcamp hosts
        $icons += [
            'fikarecordings.com' => 'bandcamp',
            'mamabirdrecordingco.com' => 'bandcamp',
            'maybemars.org' => 'bandcamp',
            'souterraine.biz' => 'bandcamp',
        ];

        foreach ($icons as $domain => $icon) {
            if (false !== strpos($value, $domain)) {
                return '<i class="fab fa-'.$icon.' fa-fw fa-lg"></i>';
            }
        }

        return '<i class="fas fa-external-link-alt fa-fw fa-lg"></i>';
    }
}
