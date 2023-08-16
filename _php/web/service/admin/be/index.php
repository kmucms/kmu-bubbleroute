<?php

use kmucms\App;

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/admin');
$this->setData('title', 'Administrationsbereich');

$adminUser = App::getInstance()->getPersonAdmin();

if (!$adminUser->isLoggedIn()) {
  $this->redirect('/service/admin/login');
}
?>


<div class="d-flexXX ">

  <!--div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 180px; display: none">


  </div-->

  <div class="container my-5" style="max-width: 400px">




    <section>
      <h4 class="text-end text-secondary">Hauptseiten</h4>
      <div class="list-group mb-3">
        <?php foreach (App::getInstance()->getDbModel()['model']['objects'] as $obj): ?>
          <?php if ($obj['attributes']['main'] ?? 0): ?>
            <a href="/service/admin/be/datatable/table/<?= $obj['name'] ?>" class="list-group-item list-group-item-action">
              <i class="<?= $obj['icon'] ?> mr-2"></i> <?= $obj['label'] ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </section>

    <section>
      <h4 class="text-end text-secondary">Daten</h4>
      <div class="list-group mb-3">
        <?php foreach (App::getInstance()->getDbModel()['model']['objects'] as $obj): ?>
          <?php if (!($obj['attributes']['main'] ?? 0) && !($obj['attributes']['debug'] ?? 0)): ?>
            <a href="/service/admin/be/datatable/table/<?= $obj['name'] ?>" class="list-group-item list-group-item-action">
              <i class="<?= $obj['icon'] ?> mr-2"></i> <?= $obj['label'] ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </section>

    <section>
      <h4 class="text-end text-secondary ">Seitenübergreifende Einstellungen</h4>
      <div class="list-group mb-3">
        <a href="<?= App::getInstance()->getGlobalVars()->getButtonLink('') ?>" class="list-group-item list-group-item-action">
          <i class="fa fa-gears mr-2"></i> Einstellungen
        </a>
        <a href="/service/admin/maintain/update" class="list-group-item list-group-item-action ">
          <i class="fa fa-repeat mr-2 text-warning"></i> Update
        </a>
      </div>
    </section>

    <section>
      <h4 class="text-end text-secondary ">Nur Lesen</h4>
      <div class="list-group mb-3">
        <?php foreach (App::getInstance()->getDbModel()['model']['objects'] as $obj): ?>
          <?php if ($obj['attributes']['debug'] ?? 0): ?>
            <a href="/service/admin/be/datatable/table/<?= $obj['name'] ?>" class="list-group-item list-group-item-action">
              <i class="<?= $obj['icon'] ?> mr-2"></i> <?= $obj['label'] ?>
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </section>


  </div>

</div>
