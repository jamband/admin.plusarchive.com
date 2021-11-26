<?php

declare(strict_types=1);

namespace app\commands;

use app\models\query\TrackQuery;
use app\models\Track;
use Jamband\Ripple\Ripple;
use SplFileObject;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\FileHelper;

/**
 * Manages track
 * @noinspection PhpUnused
 */
class TrackController extends Controller
{
    public function init(): void
    {
        parent::init();

        Yii::setAlias('@dump', Yii::getAlias('@runtime/dump'));
    }

    /**
     * @noinspection PhpUnused
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

    private static function dump(string $provider, TrackQuery $query): void
    {
        $file = new SplFileObject(Yii::getAlias("@dump/$provider.csv"), 'w');

        foreach ($query->provider($provider)->asArray()->all() as $fields) {
            $file->fputcsv($fields);
        }
    }
}
