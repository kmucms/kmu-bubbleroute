<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$person = kmucms\App::getInstance()->getPersonUser();
if($person->isLoggedIn()){
  $this->redirect('/service/person/me');
}

$this->setData('title', 'Passwort Vergeben');

$item         = $_REQUEST['item'] ?? [];
$submitButton = $_REQUEST['submitButton'] ?? '';
$name = $_GET['name'];
$token = $_GET['token'];

if($submitButton == 'ok'){
    
}

if ($submitButton == 'ok') {

}
?>

<div class="container">
  <?=
  $this->getComponent('kmucms/bootstrap/form/form', [
    'fields'        => [
      'password' => [
      'label' => 'Passwort',
      'type' => 'input',
      'mandatory' => 1,
    ],
    'password2' => [
      'label' => 'Passwort wiederholen',
      'type' => 'input',
      'mandatory' => 1,
    ],
  ],
  'valueClass'    => 'item',
    'values'        => $item,
    'submitButtons' => ['ok' => ['label' => 'Setzen']],
])
  ?>
</div>

<div class="container mt-5 text-center">
  <div class="mb-3">
    <a class="btn btn-secondary" href="/service/person/login">Zum Login</a><br/>    
  </div>
  <div class="mt-5 p-3 border bg-white rounded col-lg-6 col-md-8 mx-auto">    
    Sie haben noch kein Account? Die Registrierung ist gratis.<br/><br/>
    <a class="btn btn-primary" href="/service/person/register">Zur Registrierung</a>
  </div>
</div>