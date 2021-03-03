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
  <?=
  ''
//  $this->getComponent('bootstrap/breadcrumb', [
//    'Administratiosnbereich' => '/admin',
//    'DataPool'               => '/admin/datapool'
//  ])
  ?>


  <div class="list-group mb-3">
    <a href="/admin/datapool" class="list-group-item list-group-item-action">
      <i class="bi-diagram-3 mr-2"></i> DataPool
    </a>
  </div>

  <div class="list-group mb-3">
    <?php foreach(\kmucms\datapool\DataPool::getInstance()->getModel()['model']['objects'] as $obj): ?>
      <a href="/admin/datapool" class="list-group-item list-group-item-action">
        <i class="bi-diagram-3 mr-2"></i> <?=$obj['label']?>
      </a>
    <?php endforeach; ?>
  </div>

</div>
