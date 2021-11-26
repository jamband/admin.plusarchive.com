<?php

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
        <div class="col-lg-4">
            <?= $this->render('_search', [
                'sort' => $sort,
                'country' => $country,
                'tag' => $tag,
                'search' => $search,
                'total' => $data->totalCount,
            ]) ?>
            <h1 class="my-2">Stores</h1>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <?php /* @var Store $model */ ?>
                <?php foreach ($data->models as $model): ?>
                    <article class="col-lg-6 mb-4">
                        <h6 class="mb-1"><?= formatter()->asUrlWithText($model->url, $model->name, ['class' => 'fw-bold']) ?></h6>
                        <section class="mb-1">
                            <span class="me-2"><?= h($model->getAttributeLabel('country')) ?>:</span>
                            <?= h($model->country) ?>
                        </section>
                        <section class="mb-1">
                            <span class="me-2"><?= h($model->getAttributeLabel('link')) ?>:</span>
                            <?= formatter()->asBrandIconLink($model->link, "\n", ['class' => 'text-body']) ?>
                        </section>
                        <section class="mb-1">
                            <span class="me-2"><?= h($model->getAttributeLabel('tag')) ?>:</span>
                            <?php /** @var StoreTag $tag */ ?>
                            <?php foreach ($model->storeTags as $tag): ?>
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
