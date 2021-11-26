<?php

/**
 * @var yii\web\View $this
 * @var app\models\Track $model
 * @var string $embed
 * @var string $id
 * @var string $title
 * @var string $provider
 */

?>
<div id="track-modal" class="modal fade">
    <div class="text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <?php if (in_array($provider, ['Vimeo', 'YouTube'], true)): ?>
                <div class="ratio ratio-16x9 mb-2">
                    <iframe src="<?= h($embed) ?>" allowfullscreen></iframe>
                </div>
                <?php else: ?>
                    <iframe width="100%" height="120" src="<?= h($embed) ?>" allowfullscreen></iframe>
                <?php endif ?>
                <a class="tag" href="<?= url(['view', 'id' => $id])?>">
                    View <i class="fas fa-angle-right fa-fw"></i>
                </a>
                <div class="now-playing-loading">
                    <span>.</span><span>.</span><span>.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-2">
    <i class="fas fa-fw fa-sm fa-volume-up"></i>
    <button type="button" class="now-playing-title ms-1 align-baseline btn btn-link text-light fw-bold"><?= h($title) ?></button>
    <button type="button" class="now-playing-clear btn-close btn-sm align-text-top" aria-label="Close"></button>
</div>

<?php
$this->registerJs(<<<'JS'
var modal = new Modal(document.querySelector('#track-modal'));
modal.show();

document.querySelector('#track-modal iframe').addEventListener('load', function () {
  document.querySelector('.now-playing-loading').style.display = 'none';
})

document.querySelector('.now-playing-title').addEventListener('click', function () {
  modal.show();
})

document.querySelector('.now-playing-clear').addEventListener('click', function () {
  document.querySelector('#now-playing').innerHTML = '';
})
JS
);
