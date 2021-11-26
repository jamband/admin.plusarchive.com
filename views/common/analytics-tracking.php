<?php

/**
 * @var yii\web\View $this
 */

$this->registerJsFile('https://www.googletagmanager.com/gtag/js?id=UA-77180716-1', [
    'async' => true,
    'position' => $this::POS_HEAD,
]);

$this->registerJs(<<<'JS'
  window.dataLayer = window.dataLayer || [];
  function gtag() { dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', 'UA-77180716-1', {
    'anonymize_ip': true
  });
JS
, $this::POS_HEAD);

$this->registerJs(<<<'JS'
$(document).on('pjax:end', function () {
    gtag('config', 'UA-77180716-1', {
      'anonymize_ip': true,
      'page_path': window.location.pathname + window.location.search
    });
});
JS
);
?>
<?= h(app()->name) ?>
