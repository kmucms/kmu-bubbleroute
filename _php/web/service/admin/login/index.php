<?php
/** @var \kmucms\uipages\PageWeb $this */
$item = $_REQUEST['item'] ?? [];


if (($_REQUEST['submitButton'] ?? 0) == 'ok') {

  if (kmucms\App::getInstance()->getPersonAdmin()->doLogin($item['name'], $item['password'])) {
    $this->redirect('/service/admin/be');
  }
}

$this->setEnvelope('kmucms/index');
$this->setData('title', 'Admin-Login');
?>

<div class="container">
    <?=
    $this->getComponent('kmucms/bootstrap/form/form', [
        'fields' => [
            'name' => [
                'label' => 'Name',
                //'component' => 'bootstrap/form/items/input',
                'type' => 'input',
                'mandatory' => 1,
            ],
            'password' => [
                'label' => 'Passwort',
                //'component' => 'bootstrap/form/items/password',
                'type' => 'password',
                'default' => '',
            ],
        ],
        'valueClass' => 'item',
        'values' => $item,
        'submitButtons' => ['ok' => ['label' => 'Login']],
    ])
    ?>
</div>