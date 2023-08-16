<?php

/** @var \kmucms\uipages\PageWeb $this */
$this->setEnvelope('kmucms/index');

$person = \kmucms\App::getInstance()->getPersonUser();
$person->doLogout();

$person = \kmucms\App::getInstance()->getPersonAdmin();
$person->doLogout();

$this->redirect('/');