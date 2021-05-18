<?php

/*
 * This file is part of the admin.plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var string $tag
 * @var string $sort
 * @var string $country
 * @var string $search
 */

use app\models\Store;
use app\models\StoreTag;
use yii\widgets\Pjax;

$this->title = 'Stores - '.app()->name;
?>
<?php Pjax::begin() ?>
    <div class="row">
        <div class="col-sm-4">
            <?= $this->render('_search', [
                'sort' => $sort,
                'country' => $country,
                'tag' => $tag,
                'search' => $search,
                'total' => $data->totalCount,
            ]) ?>
            <h1 class="my-2">Stores</h1>
        </div>
        <div class="col-sm-8">
            <div class="row card-container">
                <?php /* @var Store $model */ ?>
                <?php foreach ($data->models as $model): ?>
                    <div class="col-sm-6 mb-4">
                        <?= formatter()->asUrlWithText($model->url, $model->name, ['class' => 'font-weight-bold']) ?>
                        <br>
                        <div class="badge badge-secondary">
                            <?= h($model->getAttributeLabel('country')) ?>:
                        </div>
                        <?= h($model->country) ?>
                        <br>
                        <div class="badge badge-secondary"><?= h($model->getAttributeLabel('link')) ?>:</div>
                        <?= formatter()->asBrandIconLink($model->link, "\n", ['class' => 'text-secondary']) ?>
                        <br>
                        <div class="badge badge-secondary"><?= h($model->getAttributeLabel('tag')) ?>:</div>
                        <?php /** @var StoreTag $tag */ ?>
                        <?php foreach ($model->storeTags as $tag): ?>
                            <a class="badge badge-secondary" href="<?= url(['', 'tag' => $tag->name]) ?>">
                                <?= h($tag->name) ?>
                            </a>
                        <?php endforeach ?>
                        <hr class="text-light">
                    </div>
                <?php endforeach ?>
            </div>
            <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
        </div>
    </div>
<?php Pjax::end() ?>
<?= $this->render('/common/js/card-list') ?>
