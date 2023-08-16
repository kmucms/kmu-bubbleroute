<?php

use kmucms\App;
?>

<?php
/** @var \kmucms\uipages\PageWeb $this */
if (!App::getInstance()->getPersonAdmin()->isLoggedIn()) {
  exit;
}


$this->setEnvelope('kmucms/admin');

$this->setData('title', 'datatable');

$db = App::getInstance()->getDb();

$urlInfo = App::getInstance()->getUrlInfo();

$object = $urlInfo->getSlugRessort(1);
$model = App::getInstance()->getDbModel();

if (!isset($model ['model'] ['objects'] [$object])) {
  exit();
}
$objectm = $model ['model'] ['objects'] [$object];
$id = intval($urlInfo->getSlugRessort(2) ?? 0);
$this->setData('title', $objectm ['label'] . ': id-' . $id);
$item = $_REQUEST ['item'] ?? ($id > 0 ? $db->getRowById($object, $id) : []);
if (($_REQUEST ['submitButton'] ?? '') == 'ok') {
  if ($id == 0) {
    $id = $db->addRow($object, $item);
    $this->redirect('/service/admin/be/datatable/item/' . $object . '/' . $id);
  } else {
    $db->updateRow($object, $id, $item);
  }
} elseif (($_REQUEST ['submitButton'] ?? '') == 'preview') {
  if ($id == 0) {
    $id = $db->addRow($object, $item);
  } else {
    $db->updateRow($object, $id, $item);
  }
  $this->redirect("/service/admin/be/template/toggleedit?" . http_build_query(['backurl' => $item['url'], 'editmode' => 1]));
} elseif (($_REQUEST ['submitButton'] ?? '') == 'delete') {
  if ($id > 0) {
    $db->removeRow($object, $id);
    $this->redirect('/service/admin/be/datatable/table/' . $object . '/');
  }
}
$temp_buttons = [];
if (!($objectm['attributes']['debug'] ?? false)) {
  $temp_buttons = [
    'ok' => ['label' => 'Speichern'],
    'preview' => ['label' => 'Inhalt bearbeiten'],
    'delete' => ['label' => 'Löschen', 'type' => 'danger'],
  ];
}
?>

<div class="container my-5">
  <?=
  $this->getComponent('kmucms/bootstrap/breadcrumb', ['crumb' => [
      'Admin' => '/service/admin/be',
      $objectm ['label'] => '/service/admin/be/datatable/table/' . $object],
    'current' => 'id-' . $id
  ])
  ?>

  <?=
  $this->getComponent('kmucms/bootstrap/form/form',
    ['fields' => $objectm['properties'],
      'valueClass' => 'item', 'values' => $item,
      'submitButtons' => $temp_buttons])
?>
</div>