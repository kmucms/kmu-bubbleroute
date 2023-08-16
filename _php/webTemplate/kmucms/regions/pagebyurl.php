<?php
/** @var \kmucms\uipages\PageTemplate $this */
$app = \kmucms\App::getInstance();
$items = $app->getDb()->getRows('select * from page where url like :url and url != :currenturl limit :limit',
  ['url' => $this->getValue('urlpatern'), 'limit' => max(1, intval($this->getValue('count'))), 'currenturl' => $app->getUrlInfo()->getUri()]);
?>

<div class="container" style="max-width: 600px;">
  <div class="list-group list-group-light">
    <?php foreach ($items as $item): ?>

    <a class="list-group-item d-flex justify-content-between align-items-center" href="<?= $item['url'] ?>">
        <div class="d-flex align-items-center">
          <?php if (!empty($item['img'])): ?>
            <img src="<?= $item['img'] ?>" class="rounded" alt="thumbnail: <?= $item['title'] ?>" style="max-width: 100px; max-height: 100px;">
          <?php endif; ?>
          <div class="ms-3">
            <p class="fw-bold mb-1"><?= $item['title'] ?></p>
            <p class="text-muted mb-0"><?= $item['description'] ?></p>
          </div>
        </div>
        <span class="btn btn-link btn-rounded btn-sm" role="button"><i class="fa fa-arrow-right"></i></span>
      </a>

    <?php endforeach; ?>

  </div>
  <?= $this->getButton('urlpatern,count', 'Seitenlinks') ?>
</div>

