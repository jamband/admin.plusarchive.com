<?php

/* @var $id string */
/* @var $url string */

$this->registerJs(<<<JS
$('$id').selectize({
    valueField: 'name',
    labelField: 'name',
    searchField: 'name',
    create: true,
    plugins: ['remove_button'],
    load: function(query, callback) {
        if (!query.length) {
            return callback();
        }
        console.log(query);
        $.getJSON('$url', {
            query: query
        }).done(function(data) {
            callback(data);
        }).fail(function() {
            alert('Request failure');
        });
    }
});
JS
);
