<?php

$ph = new \Phar(dirname(__DIR__).'/app.phar');
$ph->buildFromDirectory(dirname(__DIR__).'/php/');




