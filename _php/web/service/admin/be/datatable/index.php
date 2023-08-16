<?php

if(!App::getInstance()->getPersonAdmin()->isLoggedIn()){
  exit;
}

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/admin');

$this->setData('title', 'datatable');
?>

<div class="container">

  <?=
  $this->getComponent('bootstrap/breadcrumb', [
    'crumb'   => [
      'Admin' => '/admin',
    ],
    'current' => 'datatable'
  ])
  ?>

  <div class="list-group">
    <a href="/service/admin/be/datatable/edit/mainobj" class="list-group-item list-group-item-action">
      <i class="bi-square mr-3"></i> Objekte bearbeiten
    </a>
    <a href="#" class="list-group-item list-group-item-action">
      <i class="bi-list-ul mr-3"></i> Auswahlfelder
    </a>
  </div>
</div>