<?php

$admin = new \kmucms\adminuser\AdminUser();

if(!$admin->isLoggedIn()){
  exit;
}

\kmucms\datapool\DataPool::getInstance()->setModelEditVersion(json_decode($_POST['model'],true));
exit;
