<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$this->registerJsFile('//www.youtube.com/iframe_api');

$this->registerJs(<<<'JS'
var plusarchive = {
    nowPlaying: 0,
    player
};

$('#playlist').find('li').first().addClass('active');

window.onYouTubeIframeAPIReady = function() {
    plusarchive.player = new YT.Player('player', {
        videoId: $('#playlist').find('li').first().attr('data-provider-key'),
        playerVars: { rel: 0, showinfo: 0, playsinline: 1 },
        events: {
            'onStateChange': onPlayerStateChange,
            'onError': playNext
        }
    });
};

function playNext() {
    plusarchive.nowPlaying++;
    var $li = $('#playlist').find('li');
    if ($li.length > plusarchive.nowPlaying) {
        $li.eq(plusarchive.nowPlaying).addClass('active').siblings().removeClass('active');
        plusarchive.player.loadVideoById($li.eq(plusarchive.nowPlaying).attr('data-provider-key'));
    }
}

function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.ENDED) {
        playNext();
    }
}

$('#playlist').on('click', 'li', function() {
    var $this = $(this);
    plusarchive.nowPlaying = $this.index();
    $this.addClass('active').siblings().removeClass('active');
    plusarchive.player.loadVideoById($this.attr('data-provider-key'));
});
JS
);
