<?php
if (!kmucms\App::getInstance()->getPersonAdmin()->isLoggedIn()) {
  exit;
}

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/admin');

$this->setData('title', 'Neue Seite');

$par = ['item' => $_REQUEST['item']];

$meta = kmucms\App::getInstance()->getDbModel();

?>

<div class="container my-5">

  <h2>Anlegen: </h2>
  <div class="list-group">
    <?php foreach ($meta['model']['objects'] as $kobj => $obj): ?>
      <?php if ($obj['attributes']['main']): ?>
        <a href="/service/admin/be/datatable/item/<?= $kobj ?>/?<?= http_build_query($par) ?>" class="list-group-item list-group-item-action">
          <i class="bi-square mr-3"></i> <?= $obj['label'] ?>
      </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>