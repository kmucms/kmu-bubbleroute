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
$this->setData('description', $parr['name'] );
?>

<div class="container text-center">
  <a class="btn btn-primary" href="/service/person/logout">Logout</a>
  <hr/>
</div>

<div class="container mt-5">
  <dl>
    <dt>E-Mail</dt><dd><?= $item['email'] ?></dd>
    <dt>Name</dt><dd><?= $item['name'] ?></dd>
    <dt>Beschreibung</dt><dd><?= $item['description'] ?></dd>
  </dl>
  <a class="btn btn-primary" href="/service/person/me/edit">Bearbeiten</a>
</div>

