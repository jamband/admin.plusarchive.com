<?php

/**
 * @var yii\web\View $this
 */

$this->registerJs(<<<'JS'
var masonryOptions = {
  transitionDuration: 0
}

$('.card-container').masonry(masonryOptions)

$(document).on('pjax:success', function () {
  $('.card-container').masonry(masonryOptions)
});
JS
);
