<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\commands;

use app\models\query\TrackQuery;
use app\models\Track;
use jamband\ripple\Ripple;
use SplFileObject;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\FileHelper;

/**
 * TrackController class file.
 */
class TrackController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::setAlias('@dump', Yii::getAlias('@runtime/dump'));
    }

    /**
     * Creates some csv files for each provider.
     * @return int
     * @throws Exception
     */
    public function actionDump()
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
     */
    private static function dump($provider, TrackQuery $query)
    {
        $file = new SplFileObject(Yii::getAlias("@dump/$provider.csv"), 'w');

        /** @var string[] $fields */
        foreach ($query->provider($provider)->asArray()->all() as $fields) {
            $file->fputcsv($fields);
        }
    }
}
