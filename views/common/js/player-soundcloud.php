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
 */

$this->registerJsFile('//w.soundcloud.com/player/api.js');

$this->registerJs(<<<'JS'
var plusarchive = {
    nowPlaying: 0,
    player: SC.Widget('player')
};

$('#playlist').find('li').first().addClass('active');

function loadSCWidget() {
    var track = $('#playlist').find('li').eq(plusarchive.nowPlaying).attr('data-provider-key');
    plusarchive.player.load('//api.soundcloud.com/tracks/' + track, {
        auto_play: true,
        visual: true,
        show_comments: false
    });
}

function playNext() {
    plusarchive.nowPlaying++;
    var $li = $('#playlist').find('li');
    if ($li.length > plusarchive.nowPlaying) {
        $li.eq(plusarchive.nowPlaying).addClass('active').siblings().removeClass('active');
        loadSCWidget();
    }
}

plusarchive.player.bind(SC.Widget.Events.ERROR, playNext);
plusarchive.player.bind(SC.Widget.Events.FINISH, playNext);

$('#playlist').on('click', 'li', function() {
    var $this = $(this);
    plusarchive.nowPlaying = $this.index();
    $this.addClass('active').siblings().removeClass('active');
    loadSCWidget();
});
JS
);
