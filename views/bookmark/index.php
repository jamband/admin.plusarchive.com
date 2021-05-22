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
 * @var string $sort
 * @var string $country
 * @var string $tag
 * @var string $search
 */

use app\models\Bookmark;
use app\models\BookmarkTag;
use yii\widgets\Pjax;

$this->title = 'Bookmarks - '.app()->name;
?>
<?php Pjax::begin() ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $this->render('_search', [
                'sort' => $sort,
                'country' => $country,
                'tag' => $tag,
                'search' => $search,
                'total' => $data->totalCount,
            ]) ?>
            <h1 class="my-2">Bookmarks</h1>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <?php /** @var Bookmark $model */ ?>
                <?php foreach ($data->models as $model): ?>
                    <div class="col-lg-6 mb-4">
                        <?= formatter()->asUrlWithText($model->url, $model->name, ['class' => 'fw-bold']) ?>
                        <br>
                        <div class="tag">
                            <?= h($model->getAttributeLabel('country')) ?>:
                        </div>
                        <?= h($model->country) ?>
                        <br>
                        <div class="tag"><?= h($model->getAttributeLabel('link')) ?>:</div>
                        <?= formatter()->asBrandIconLink($model->link, "\n", ['class' => 'text-secondary']) ?>
                        <br>
                        <span class="tag"><?= h($model->getAttributeLabel('tagValues')) ?>:</span>
                        <?php /** @var BookmarkTag $tag */ ?>
                        <?php foreach ($model->bookmarkTags as $tag): ?>
                            <a class="tag" href="<?= url(['', 'tag' => $tag->name]) ?>">
                                <?= h($tag->name) ?>
                            </a>
                        <?php endforeach ?>
                        <hr>
                    </div>
                <?php endforeach ?>
            </div>
            <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
        </div>
    </div>
<?php Pjax::end() ?>
