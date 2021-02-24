<?php
/** @var \kmucms\uipages\PageWeb $this */

$this->setPageEnvelope('index');

if(! (new \kmucms\adminuser\AdminUser())->isLoggedIn()){
  $this->redirect('/admin/login');
}

echo 'admin';
