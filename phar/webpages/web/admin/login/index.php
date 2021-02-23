<?php
/** @var \kmucms\uipages\PageWeb $this */

$item = $_REQUEST['item'] ?? [];
if(($_REQUEST['submitButton'] ?? 0) == 'ok'){
  if((new kmucms\adminuser\AdminUser())->doLogin($item['name'], $item['password'])){
    $this->redirect('/admin');
  }
}

$this->setPageEnvelope('index');
$this->setData('title', 'Login');
?>

<div class="container">
  <?=
  $this->getComponent('bootstrap/form/form', [
    'fields'        => [
      'name'     => [
        'label'     => 'Name',
        'component' => 'bootstrap/form/items/input',
        'mandatory' => 1,
      ],
      'password' => [
        'label'     => 'Passwort',
        'component' => 'bootstrap/form/items/input',
        'default'   => '',
      ],
    ],
    'valueClass'    => 'item',
    'values'        => $item,
    'submitButtons' => ['ok' => ['label' => 'Login']],
  ])
  ?>
</div>