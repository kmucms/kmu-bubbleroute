<?php

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$person = kmucms\person\PersonFe::getInstance();
if(!$person->isLoggedIn()){
  $this->redirect('/service/person/login');
}

$parr = $person->getInstance()->getCurrentPerson();

$item         = $_REQUEST['item'] ?? $parr;
$submitButton = $_REQUEST['submitButton'] ?? '';


$this->setData('title', 'Persönlicher Bereich');
$this->setData('description', $parr['name']);

$formData = require 'index.form.php';
?>

<div class="container mt-5">
<?=
$this->getComponent('kmucms/bootstrap/form/form', ['values' => $item,] + $formData)
?>
</div>

