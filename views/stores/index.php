<?php

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $data
 * @var string|null $country
 * @var string|null $tag
 * @var string|null $search
 */

use app\models\Store;
use app\models\StoreTag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Stores - '.Yii::$app->name;
?>
<?php Pjax::begin() ?>
    <div class="row">
        <div class="col-lg-4">
            <?= $this->render('_search', [
                'country' => $country,
                'tag' => $tag,
                'search' => $search,
                'pageParam' => $data->pagination->pageParam,
                'total' => $data->totalCount,
            ]) ?>
            <h1 class="my-2">Stores</h1>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <?php /* @var Store $model */ ?>
                <?php foreach ($data->models as $model): ?>
                    <article class="col-lg-6 mb-4">
                        <h6 class="mb-1"><?= Yii::$app->formatter->asUrlWithText($model->url, $model->name, ['class' => 'fw-bold']) ?></h6>
                        <section class="mb-1">
                            <span class="me-2 text-light"><?= Html::encode($model->getAttributeLabel('country')) ?>:</span>
                            <?= Html::encode($model->country) ?>
                        </section>
                        <section class="mb-1">
                            <span class="me-2 text-light"><?= Html::encode($model->getAttributeLabel('link')) ?>:</span>
                            <?= Yii::$app->formatter->asBrandIconLink($model->link, options: ['class' => 'me-1 tag']) ?>
                        </section>
                        <section class="mb-1">
                            <span class="me-2 text-light"><?= Html::encode($model->getAttributeLabel('tag')) ?>:</span>
                            <?php /** @var StoreTag $tag */ ?>
                            <?php foreach ($model->tags as $tag): ?>
                                <a class="tag" href="<?= Url::to(['', 'tag' => $tag->name]) ?>">
                                    <?= Html::encode($tag->name) ?>
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
