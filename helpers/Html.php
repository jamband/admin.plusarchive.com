<?php

declare(strict_types=1);

namespace yii\helpers;

use stdClass;
use Yii;

class Html extends BaseHtml
{
    public static function asset(string $file): string
    {
        $manifest = Yii::getAlias('@app/web/assets/manifest.json');

        $manifest = file_exists($manifest)
            ? json_decode(file_get_contents($manifest))
            : new stdClass;

        return property_exists($manifest, $file)
            ? '/assets/'.$manifest->$file
            : '/assets/'.$file;
    }
}
