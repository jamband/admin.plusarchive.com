<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var string $sort
 * @var string $country
 * @var string $tag
 * @var string $search
 */

use app\models\Bookmark;
use app\models\BookmarkTag;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Bookmarks - '.app()->name;
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
            <h2 class="my-2">Bookmarks</h2>
        </div>
        <div class="col-sm-8">
            <div class="row card-container">
                <?php /** @var Bookmark $model */ ?>
                <?php foreach ($data->models as $model): ?>
                    <div class="col-sm-6 mb-4">
                        <?= Html::a(h($model->name), h($model->url), [
                            'class' => 'external-link',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ]) ?>
                        <br>
                        <div class="badge badge-secondary">
                            <?= h($model->getAttributeLabel('country')) ?>:
                        </div>
                        <?= h($model->country) ?>
                        <br>
                        <div class="badge badge-secondary"><?= h($model->getAttributeLabel('link')) ?>:</div>
                        <?= formatter()->asSnsIconLink($model->link, "\n", [], [
                            'class' => 'text-secondary',
                            'rel' => 'noopener',
                            'target' => '_blank',
                        ]) ?>
                        <br>
                        <span class="badge badge-secondary"><?= h($model->getAttributeLabel('tagValues')) ?>:</span>
                        <?php /** @var BookmarkTag $tag */ ?>
                        <?php foreach ($model->bookmarkTags as $tag): ?>
                            <?= Html::a(h($tag->name), ['', 'tag' => $tag->name], [
                                'class' => 'badge badge-secondary',
                            ]) ?>
                        <?php endforeach ?>
                        <hr>
                    </div>
                <?php endforeach ?>
            </div>
            <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
        </div>
    </div>
<?php Pjax::end() ?>
<?= $this->render('/common/js/card-list') ?>
