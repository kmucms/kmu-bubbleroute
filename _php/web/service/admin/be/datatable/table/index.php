<?php

use kmucms\App;

if (!App::getInstance()->getPersonAdmin()->isLoggedIn()) {
  exit;
}

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/admin');

$this->setData('title', 'datatable');

//$dp = \kmucms\datatable\datatable::getInstance();
$db = App::getInstance()->getDb();

$object = App::getInstance()->getUrlInfo()->getSlugRessort(1);

$model = App::getInstance()->getDbModel();

if (!isset($model['model']['objects'][$object])) {
  exit;
}

$objProp = $model['model']['objects'][$object]['properties'];

$this->setData('title', $model['model']['objects'][$object]['label']);
?>

<div class="my-5">
  <div class="container">
    <?=
    $this->getComponent('kmucms/bootstrap/breadcrumb', ['crumb' => [
        'Admin' => '/service/admin/be'],
      'current' => $model['model']['objects'][$object]['label'],
])
    ?>

  </div>

  <?php if (!($model['model']['objects'][$object]['attributes']['debug'] ?? false)): ?>
    <div class="container mb-2">
    <a href="/service/admin/be/datatable/item/<?= $object ?>" class="btn btn-primary w-100" ><i class="fa fa-plus"></i> Neu</a>
    </div>
  <?php endif; ?>

  <div class="text-center">
    <table class="mx-auto table table-striped">
      <thead>
        <tr>
          <th  scope="col">id</th>
          <?php foreach ($objProp as $propMetaK => $propMeta): ?>
            <?php if ($propMeta['beTable'] ?? true): ?>
              <th  class="px-3"  scope="col"><?= $propMeta['label'] ?? $propMetaK ?></th>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      </thead>
      <?php foreach ($db->getRows("select * from $object order by id desc") as $obj): ?>
        <tr>
          <td>
            <a href="/service/admin/be/datatable/item/<?= $object ?>/<?= $obj['id'] ?>" class="btn btn-primary"><?= $obj['id'] ?></a>
          </td>
          <?php foreach ($objProp as $propMetaK => $propMeta): ?>
            <?php if ($propMeta['beTable'] ?? true): ?>
              <td class="px-3"><?= $this->getComponent('kmucms/bootstrap/tablecell/tablecell', ['field' => $propMeta, 'value' => $obj[$propMetaK] ?? '']) ?></td>
            <?php endif; ?>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>