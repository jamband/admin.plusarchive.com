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
 * @var string $id
 * @var string $url
 */

$this->registerJs(<<<JS
$('$id').selectize({
    delimiter: ', ',
    persist: false,
    valueField: 'name',
    labelField: 'name',
    searchField: 'name',
    create: true,
    plugins: ['remove_button'],
    load: function (query, callback) {
        if (!query.length) {
            return callback();
        }
        $.getJSON('$url', {
            query: query
        }).done(function (data) {
            callback(data);
        }).fail(function () {
            alert('Request failure');
        });
    }
});
JS
);
