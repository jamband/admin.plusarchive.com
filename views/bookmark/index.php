<?php

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
                    <article class="col-lg-6 mb-4">
                        <h6 class="mb-1"><?= formatter()->asUrlWithText($model->url, $model->name, ['class' => 'fw-bold']) ?></h6>
                        <section class="mb-1">
                            <span class="me-2 text-light"><?= h($model->getAttributeLabel('country')) ?>:</span>
                            <?= h($model->country) ?>
                        </section>
                        <section class="mb-1">
                            <span class="me-2 text-light"><?= h($model->getAttributeLabel('link')) ?>:</span>
                            <?= formatter()->asBrandIconLink($model->link, "\n", ['class' => 'text-body']) ?>
                        </section>
                        <section class="mb-1">
                            <span class="me-2 text-light"><?= h($model->getAttributeLabel('tagValues')) ?>:</span>
                            <?php /** @var BookmarkTag $tag */ ?>
                            <?php foreach ($model->bookmarkTags as $tag): ?>
                                <a class="tag" href="<?= url(['', 'tag' => $tag->name]) ?>">
                                    <?= h($tag->name) ?>
                                </a>
                            <?php endforeach ?>
                        </section>
                        <hr>
                    </article>
                <?php endforeach ?>
            </div>
            <?= $this->render('/common/pagination', ['pagination' => $data->pagination]) ?>
        </div>
    </div>
<?php Pjax::end() ?>
