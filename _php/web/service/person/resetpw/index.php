<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$person = kmucms\App::getInstance()->getPersonUser();
if($person->isLoggedIn()){
  $this->redirect('/service/person/me');
}

$this->setData('title', 'Passwort Zurücksetzen');

$item         = $_REQUEST['item'] ?? [];
$submitButton = $_REQUEST['submitButton'] ?? '';

if ($submitButton == 'ok') {
  //check new stuff
  $person->sendNewPwMail($item['email'],'/service/person/resetpw/verify');
}

?>


<div class="container">
  <?=
  $this->getComponent('kmucms/bootstrap/form/form', [
    'fields'        => [
      'email'     => [
        'label'     => 'Email',
        'type'      => 'input',
        'mandatory' => 1,
      ],
    ],
    'valueClass'    => 'item',
    'values'        => $item,
    'submitButtons' => ['ok' => ['label' => 'Zurücksetzen']],
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