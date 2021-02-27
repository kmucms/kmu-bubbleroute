<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope('index');
$this->setData('title', 'Administrationsbereich');

$adminUser = new \kmucms\adminuser\AdminUser();

if(!$adminUser->isLoggedIn()){
  $this->redirect('/admin/login');
}
?>


<div class="container">
  <?= ''
//  $this->getComponent('bootstrap/breadcrumb', [
//    'Administratiosnbereich' => '/admin',
//    'DataPool'               => '/admin/datapool'
//  ])
  ?>


  <div class="list-group">
    <a href="/admin/datapool" class="list-group-item list-group-item-action">
      <i class="bi-diagram-3 mr-2"></i> DataPool
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled">
      <i class="bi-image mr-2"></i> Mediengalerie
    </a>
    <a href="#" class="list-group-item list-group-item-action disabled">
      <i class="bi-people mr-2"></i> Benutzerverwaltung
    </a>
  </div>
</div>
