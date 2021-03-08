<?php

$admin = new \kmucms\adminuser\AdminUser();

if(!$admin->isLoggedIn()){
  exit;
}

\kmucms\datapool\DataPool::getInstance()->compile();
echo 'ok';
exit;
