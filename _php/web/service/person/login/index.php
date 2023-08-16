<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');
$this->setData('title', 'Login');

$item         = $_REQUEST['item'] ?? [];
$submitButton = $_REQUEST['submitButton'] ?? '';


$person = kmucms\App::getInstance()->getPersonUser();

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if($person->isLoggedIn()){
  $this->redirect('/service/person/me');
}

if($submitButton == 'ok'){
  if($person->doLogin($item['email'], $item['password'])){
     $this->redirect('/service/person/me');
  }
}


?>

<div class="container">
  <?=
  $this->getComponent('kmucms/bootstrap/form/form', [
    'fields'        => [
      'email'     => [
        'label'     => 'E-Mail',
        'type'      => 'input',
        'mandatory' => 1,
      ],
      'password' => [
        'label'   => 'Passwort',
        'type'    => 'password',
        'default' => '',
        'mandatory' => 1,
      ],
    ],
    'valueClass'    => 'item',
    'values'        => $item,
    'submitButtons' => ['ok' => ['label' => 'Login']],
  ])
  ?>
</div>
<div class="container mt-5 text-center">
  <div class="mb-3">
    <a class="btn btn-secondary" href="/service/person/resetpw">Passwort vergessen?</a><br/>    
  </div>
  <div class="mt-5 p-3 border bg-white rounded col-lg-6 col-md-8 mx-auto">    
    Sie haben noch kein Account? Die Registrierung ist gratis.<br/><br/>
    <a class="btn btn-primary" href="/service/person/register">Zur Registrierung</a>
  </div>
</div>