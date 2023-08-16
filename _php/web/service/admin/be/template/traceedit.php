<?php

use kmucms\App;

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/admin');
$this->setData('title', 'Seitendaten bearbeiten');

$adminUser = App::getInstance()->getPersonAdmin();

if (!$adminUser->isLoggedIn()) {
  exit;
}



//daten laden
$traceId = $_GET['traceid'];

//templatemeta laden
$module = $_GET['module'];
$template = $_GET['templateid'];
$path = kmucms\Format::trimexplode('/', $_GET['path']);
$vars = kmucms\Format::trimexplode(',', $_GET['vars']);

$meta = [];
if ($module == 'web') {
  $meta = \kmucms\uipages\PageWeb::getInputMeta($template);
} elseif ($module == 'template') {
  $meta = \kmucms\uipages\PageTemplate::getInputMeta($template);
} elseif ($module == 'globals') {
  $meta = \Symfony\Component\Yaml\Yaml::parseFile(App::getInstance()->getPaths()->getPhp() . '/db/globals.input.yml');
  if (count($vars) === 0) {
    $vars = array_keys($meta);
  }
}
$meta_form = [];

foreach ($vars as $var) {
  if (isset($meta[$var])) {
    $meta_form[$var] = $meta[$var];
  } else {
    $meta_form[$var] = ['type' => 'string', 'label' => $var];
  }
}

//backurl
$backurl = $_GET['backurl'];

$db = App::getInstance()->getDb();

if (isset($_REQUEST['item'])) {
  $item = $_REQUEST['item'];
} else {
  $row = $db->getRowByCondition('vartrace', "traceid=:traceid", ['traceid' => $traceId]);
  $data = json_decode($row['data'] ?? '[]', true);
  $current = &$data;
  foreach ($path as $step) {
    if (!isset($current[$step])) {
      $new = [];
      $current[$step] = $new;
    }
    $current = &$current[$step];
  }
  $item = $current;
  unset($current);
}

if (($_REQUEST['submitButton'] ?? 0) == 'cancel') {
  $this->redirect($backurl);
} elseif (($_REQUEST['submitButton'] ?? 0) == 'ok') {
  $lastItem = $db->getRowByCondition('vartrace', "traceid=:traceid", ['traceid' => $traceId]);
  $data = count($lastItem) == 0 ? [] : (json_decode($lastItem['data'], true) ?? []);
  $current = &$data;
  foreach ($path as $step) {
    if (!isset($current[$step])) {
      $new = [];
      $current[$step] = $new;
    }
    $current = &$current[$step];
  }
  foreach ($item as $k => $v) {
    $current[$k] = $v;
  }
  unset($current);
  if (count($lastItem) == 0) { //insert
    $db->addRow('vartrace', ['traceid' => $traceId, 'data' => json_encode($data)]);
  } else { //update
    $db->updateRow('vartrace', $lastItem['id'], ['data' => json_encode($data)]);
  }
}



//formular
?>

<div class="container my-5">
  <?=
  $this->getComponent('kmucms/bootstrap/form/form', [
    'fields' => $meta_form,
    'valueClass' => 'item',
    'values' => $item,
    'submitButtons' => ['ok' => ['label' => 'Speichern'], 'cancel' => ['label' => 'Zurück']],
  ])
  ?>
</div>