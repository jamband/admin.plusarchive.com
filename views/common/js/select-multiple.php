<?php

/**
 * @var yii\web\View $this
 * @var string $id
 */

$this->registerJs(<<<JS
$('$id').select2({
    multiple: true,
    tags: true
});
JS
);
