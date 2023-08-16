<?php


/** @var \kmucms\uipages\PageWeb $this */

$admin = \kmucms\App::getInstance()->getPersonAdmin();
if(!$admin->isLoggedIn()){
  exit;
}

$admin->toggleEditMode();

if (isset($_GET['editmode'])) {
  $admin->setEditMode(boolval($_GET['editmode']));
}

$this->redirect($_GET['backurl']);


