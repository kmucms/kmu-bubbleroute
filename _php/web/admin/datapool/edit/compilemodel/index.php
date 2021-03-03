<?php

$admin = new \kmucms\adminuser\AdminUser();

if(!$admin->isLoggedIn()){
  exit;
}

\kmucms\datapool\DataPool::getInstance()->setModel(json_decode($_POST['model'],true));
exit;
