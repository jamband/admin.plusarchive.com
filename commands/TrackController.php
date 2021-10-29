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

namespace app\commands;

use app\models\query\TrackQuery;
use app\models\Track;
use Jamband\Ripple\Ripple;
use SplFileObject;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\FileHelper;

/**
 * Manages track
 * @noinspection PhpUnused
 */
class TrackController extends Controller
{
    /**
     * @return void
     */
    public function init(): void
    {
        parent::init();

        Yii::setAlias('@dump', Yii::getAlias('@runtime/dump'));
    }

    /**
     * Creates some csv files for each provider.
     * @noinspection PhpUnused
     *
     * @return int
     * @throws Exception
     */
    public function actionDump(): int
    {
        FileHelper::createDirectory(Yii::getAlias('@dump'));

        foreach (Ripple::providers() as $provider) {
            static::dump($provider, Track::find()->select(['id', 'url']));
        }

        $this->stdout('All data has been dumped in '.Yii::getAlias('@dump').".\n");

        return ExitCode::OK;
    }

    /**
     * @param string $provider
     * @param TrackQuery $query
     * @return void
     */
    private static function dump(string $provider, TrackQuery $query): void
    {
        $file = new SplFileObject(Yii::getAlias("@dump/$provider.csv"), 'w');

        /** @var string[] $fields */
        foreach ($query->provider($provider)->asArray()->all() as $fields) {
            $file->fputcsv($fields);
        }
    }
}
