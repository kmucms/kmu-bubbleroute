<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope();

$this->setData('title', 'DataPool');
?>

<div class="container">

  <?=
  $this->getComponent('bootstrap/breadcrumb', [
    'crumb'   => [
      'Admin' => '/admin',
    ],
    'current' => 'Datapool'
  ])
  ?>

  <div class="list-group">
    <a href="/admin/datapool/edit/mainobj" class="list-group-item list-group-item-action">
      <i class="bi-square mr-3"></i> Objekte bearbeiten
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <i class="bi-list-ul mr-3"></i> Auswahlfelder
    </a>
  </div>
</div>